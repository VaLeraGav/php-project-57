<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use Illuminate\Http\Request;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Auth;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskStatuses = TaskStatus::paginate(10);
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        $this->authorize('create', [self::class]);

        $taskStatus = new TaskStatus();
        return view('task_statuses.create', compact('taskStatus'));
    }

    public function store(StoreTaskStatusRequest $request)
    {
        if (Auth::guest()) {
            return redirect()->route('task_statuses.index');
        }

        $data = $request->validated();
        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('flash.status.added'))->success();
        return redirect()
            ->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        $this->authorize('update', [self::class]);

        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus)
    {
        if (Auth::guest()) {
            return redirect()->route('task_statuses.index');
        }

        $data = $request->validated();
        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('flash.status.edited'))->success();
        return redirect()
            ->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus->task()->exists()) {
            flash(__('flash.status.failed'))->error();
            return redirect()->route('task_statuses.index');
        }

        $taskStatus->delete();
        flash(__('flash.status.deleted'))->success();
        return redirect()->route('task_statuses.index');
    }
}
