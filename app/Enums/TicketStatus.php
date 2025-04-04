<?php

namespace App\Enums;

enum TicketStatus: string
{
    case A = 'Aberto';
    case F = 'Finalizado';

    
    public static function formValue(string $name)
    {
        foreach (TicketStatus::cases() as $status) {
            if ($name === $status->name) {
                return $status->value;
            }
            else{
                throw new \ValueError("$name inválido");
            }

        }
    }
}