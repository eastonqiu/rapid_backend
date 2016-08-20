<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before($user, $ability)
    {
        if ($user->can('user-' . $ability)) {
            return true;
        }
    }

    public function show(User $user, User $toUser)
    {
        return $user->id == $toUser->id;
    }

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $toUser
     * @return bool
     */
    public function update(User $user, User $toUser)
    {
        return $user->id == $toUser->id;
    }

    public function delete(User $user, User $toUser)
    {
        return $user->id == $toUser->id;
    }

}
