<?php

namespace App\Policies;

use App\Models\UserMeta;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

      
    public function create(UserMeta $user)
    {
        return $user->role === 'manager';
    }

    public function update(UserMeta $user, UserMeta $targetUser)
    {
        return $user->role === 'manager' && $user->id !== $targetUser->id;
    }

    public function destroy(UserMeta $user, UserMeta $targetUser)
    {
        return $user->role === 'manager' && $user->id !== $targetUser->id;
    }
}
