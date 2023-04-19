<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    public function admin(User $user)
    {
        return $user->role->code === "admin";
    }

    public function waiter(User $user)
    {
        return $user->role->code === "waiter";
    }

    public function cook(User $user)
    {
        return $user->role->code === "cook";
    }

    public function cookOrWaiter(User $user)
    {
        return $user->role->code === "cook" || $user->role->code === "waiter";
    }
}
