<?php

namespace App\Policies;

use App\Models\Commentary\Commentary;
use App\Models\User;

class CommentaryPolicy
{
    public function delete(User $user, Commentary $comment): bool
    {   
        if ($user->id === $comment->user_id) {
            return true; 
        }
        return $user->hasRole('superadmin');
    }
    public function edit(User $user, Commentary $comment): bool
    {
        if ($user->id === $comment->user_id) {
            return true;
        }
        return $user->hasRole('superadmin');
    }
}
