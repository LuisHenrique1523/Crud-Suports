<?php

namespace App\Services;

use App\DTO\Replies\CreateReplyDTO;
use stdClass;

class ReplyTicketService
{
    public function getALLByTicketId(string $ticketId)
    {
        return [];
    }

    public function createNew(CreateReplyDTO $dto): stdClass
    {
        throw new \Exception('not implemented');
    }
}