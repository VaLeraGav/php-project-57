<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(10);
        $users = User::pluck('name', 'id')->all();
        $taskStatuses = TaskStatus::pluck('name', 'id')->all();

        return view('tasks.index', compact('tasks', 'users', 'taskStatuses'));
    }

    public function create()
    {
        if (Auth::guest()) {
            return abort(403);
        }

        $taskStatuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $labels = Label::pluck('name', 'id')->all();

        return view('tasks.create', compact('taskStatuses', 'users', 'labels'));
    }

    public function show(Task $task)
    {
        if (Auth::guest()) {
            return redirect()->route('tasks.index');
        }
        return view('tasks.show', compact('task'));
    }

    public function store(StoreTaskRequest $request)
    {
        if (Auth::guest()) {
            return redirect()->route('tasks.index');
        }

        $data = $request->validated();
        $user = Auth::user();

        $task = $user->tasks()->make($data);
        $task->save();
        $task->labels()->sync($request->labels);

        flash(__('flash.task.added'))->success();
        return redirect()
            ->route('tasks.index');
    }

    public function edit(Task $task)
    {
        if (Auth::guest()) {
            abort(403);
        }

        $taskStatus = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $labels = Label::pluck('name', 'id')->all();

        return view('tasks.edit', compact('task', 'taskStatus', 'users', 'labels'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        if (Auth::guest()) {
            return redirect()->route('tasks.index');
        }

        $data = $request->validated();
        $task->update($data);
        $task->save();

        $task->labels()->sync($request->labels);

        flash(__('flash.task.edited'))->success();
        return redirect()
            ->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if (Auth::id() === $task->created_by_id) {
            $task->labels()->detach();
            $task->delete();
            flash(__('flash.task.delete'))->success();
        }
        return redirect()->route('tasks.index');
    }
}
