<?php

namespace App\Policies;

use App\Models\Ideas;
use App\Models\User;

class IdeasPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function workWith(User $user, Ideas $idea): bool{
        return $idea->user->is($user);
    }
}
