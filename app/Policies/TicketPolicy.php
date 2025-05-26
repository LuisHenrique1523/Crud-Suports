<?php

namespace App\Policies;

use App\Models\Ticket\Ticket;
use App\Models\User;

class TicketPolicy
{
    public function before(User $user, Ticket $ticket): ?bool
    {
        if ($user->hasRole('superadmin')) {
            return true;
        }
    return null;
    }
    public function delete(User $user, Ticket $ticket): bool
    {
        return $user->id === $ticket->user_id;
    }
}
