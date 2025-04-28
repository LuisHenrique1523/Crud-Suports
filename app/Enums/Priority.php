<?php

namespace App\Enums;

enum Priority: string
{
    case HIGH = '0';
    case MEDIUM = '1';
    case LOW = '2';
    public function change()
    {
        return match ($this) 
        {
            self::HIGH => 'Alta',
            self::MEDIUM => 'Média',
            self::LOW => 'Baixa',
        };
    }
    public function color()
    {
        return match ($this)
        {
            self::HIGH => 'red',
            self::MEDIUM => 'yellow',
            self::LOW => 'green',
        };
    }
}
