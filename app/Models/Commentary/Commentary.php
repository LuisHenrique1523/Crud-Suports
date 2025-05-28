<?php

namespace App\Models\Commentary;

use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    protected $table = 'commentaries';
    protected $fillable = ['content'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
