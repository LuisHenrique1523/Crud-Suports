<?php

namespace App\Models\Operation;

use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $table = 'operations';
    protected $fillable = ['description'];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
