<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUserWithPosts(User $user)
    {
        return [
            'user' => $user,
            'posts' => $user->posts,
        ];
    }
}
