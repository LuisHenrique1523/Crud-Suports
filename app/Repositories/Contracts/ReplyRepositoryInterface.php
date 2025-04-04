<?php

namespace App\Repositories\Contracts;

use App\DTO\Replies\CreateReplyDTO;
use stdClass;

interface ReplyRepositoryInterface
{
    public function getALLByTicketId(string $ticketId);
    public function createNew(CreateReplyDTO $dto): stdClass;
}