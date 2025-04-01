<?php

use App\Enums\TicketStatus;

if (!function_exists('getStatusTicket')) {
    function getStatusTicket(string $status){
        return TicketStatus::formValue($status);
    }
}