<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TaskControllerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Task $task)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update()
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Task $task)
    {
        return $task->creator()->is($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Task $task)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Task $task)
    {
        return false;
    }
}
