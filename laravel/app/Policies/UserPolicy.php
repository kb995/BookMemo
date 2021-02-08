<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return $user->id == Auth::id();
    }

    public function update(User $user)
    {
        return $user->id == Auth::id();
    }

    public function delete(User $user)
    {
        return $user->id == Auth::id();
    }

}
