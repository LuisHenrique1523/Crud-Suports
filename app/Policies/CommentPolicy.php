<?php

namespace App\Policies;

use App\Models\Comemntary\Commentary;
use App\Models\User;

class CommentPolicy
{
    public function delete(User $user, Commentary $comment): bool
    {
        if ($user->id === $comment->user_id) {
            return true;
        }
        return $user->hasRole('superadmin');
    }
}
