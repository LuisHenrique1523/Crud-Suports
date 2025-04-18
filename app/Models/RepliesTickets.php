<?php

namespace App\Models;

use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepliesTickets extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'replies_ticket';
    protected $fillable = ['reply'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
