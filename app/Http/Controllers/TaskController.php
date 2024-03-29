<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(Request $request)
    {
        $users = User::pluck('name', 'id')->all();
        $taskStatuses = TaskStatus::pluck('name', 'id')->all();
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->orderBy('id', 'asc')
            ->paginate(10);
        $filter = $request->filter;

        return view('tasks.index', compact('tasks', 'users', 'taskStatuses', 'filter'));
    }

    public function create()
    {
        $taskStatuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $labels = Label::pluck('name', 'id')->all();

        return view('tasks.create', compact('taskStatuses', 'users', 'labels'));
    }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        $task = $user->tasks()->make();
        $task->fill($data);
        $task->save();

        $labels = $request->input('labels') ?? [];

        $result = array_filter($labels, function ($label) {
            return isset($label);
        });

        $task->labels()->sync($result);

        flash(__('flash.task.added'))->success();
        return redirect()
            ->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $taskStatus = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $labels = Label::pluck('name', 'id')->all();

        return view('tasks.edit', compact('task', 'taskStatus', 'users', 'labels'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->validated();

        $task->fill($data);
        $task->save();

        $labels = $request->input('labels') ?? [];

        $result = array_filter($labels, function ($label) {
            return isset($label);
        });

        $task->labels()->sync($result);

        flash(__('flash.task.edited'))->success();
        return redirect()
            ->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->labels()->detach();
        $task->delete();

        flash(__('flash.task.deleted'))->success();
        return redirect()
            ->route('tasks.index');
    }
}
