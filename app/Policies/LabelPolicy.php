<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class LabelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return bool
     */
    public function viewAny()
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return bool
     */
    public function view()
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @return bool
     */
    public function create()
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return bool
     */
    public function update()
    {
        return  true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return bool
     */
    public function delete()
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @return bool
     */
    public function restore()
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return bool
     */
    public function forceDelete()
    {
        return false;
    }
}
