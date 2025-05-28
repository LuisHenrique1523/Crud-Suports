<?php

namespace App\Policies;

use App\Models\Operation\Operation;
use App\Models\User;

class OperationPolicy
{
    public function delete(User $user, Operation $operation): bool
    {
        if ($user->id === $operation->user_id) {
            return true;
        }
        return $user->hasRole('superadmin');
    }
    public function edit(User $user, Operation $operation): bool
    {
        if ($user->id === $operation->user_id) {
            return true;
        }
        return $user->hasRole('superadmin');
    }
}
