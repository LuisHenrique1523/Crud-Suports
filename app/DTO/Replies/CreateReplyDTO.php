<?php

namespace App\DTO\Replies;

class  CreateReplyDTO
{
    public function __construct(
        public string $ticketId,
        public string $content,
    ){
        
    }
}