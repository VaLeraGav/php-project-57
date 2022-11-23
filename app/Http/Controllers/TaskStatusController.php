<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;

class TaskStatusController extends Controller
{

    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('task_statuses.create', compact('taskStatus'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|min:5|max:20',
        ]);
        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();
        flash('Статус успешно добавлен!')->success();
        return redirect()
            ->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses,name|max:20'
        ]);
        $taskStatus->fill($data);
        $taskStatus->save();
        flash('Статус отредактирован успешно!')->success();
        return redirect()
            ->route('task_statuses.index');
    }

    public function destroy($id)
    {
        $taskStatus = TaskStatus::find($id);
        if ($taskStatus) {
            $taskStatus->delete();
            flash('Статус успешно удален!')->success();
        }
        return redirect()->route('task_statuses.index');
    }
}
