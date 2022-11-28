<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $task =  new Task();
        $taskStatuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        return view('tasks.create', compact('task', 'taskStatuses', 'users'));
    }

    public function show(Task $task)
    {

        return view('tasks.show', compact('task'));
    }
}
