<?php
namespace App\Enums;


enum PriorityEnum: string
{
    case HIGH = '0';
    case MEDIUM = '1';
    case LOW = '2';
    public function change()
    {
        return match ($this) 
        {
            self::HIGH => 'Alta',
            self::MEDIUM => 'Media',
            self::LOW => 'Baixa',
        };
    }
}
