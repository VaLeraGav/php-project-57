<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use Illuminate\Http\Request;
use App\Models\TaskStatus;

class TaskStatusController extends Controller
{

    public function index()
    {
        $taskStatuses = TaskStatus::paginate(10);
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('task_statuses.create', compact('taskStatus'));
    }

    public function store(StoreTaskStatusRequest $request)
    {
//        $data = $this->validate($request, [
//            'name' => 'required|min:3|max:255|unique:task_statuses,name',
//        ]);

//        $data = $request->validate(
//            ['name' => 'required|max:100|unique:task_statuses'],
//            $messages = [
//                'unique' => 'Статус с таким именем уже существует',
//                'max' => 'Имя не должно превышать 100 символов',
//                'required' => 'Это обязательное поле'
//            ]
//        );

        $data = $request->validated();

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

    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus)
    {
//        $data = $this->validate($request, [
//            'name' => 'required|max:255|unique:task_statuses,name'
//        ]);

        $data = $request->validated();

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
