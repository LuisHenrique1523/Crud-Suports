<?php

namespace App\Enums;

enum TicketStatus: string
{
    case A = 'Aberto';
    case F = 'Finalizado';

    
    public static function formValue(string $name): string
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status->value;
            }
        }

        throw new \ValueError("$status inválido");
    }
}