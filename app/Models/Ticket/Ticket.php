<?php

namespace App\Models\Ticket;

use App\Models\Category\category;
use App\Models\RepliesTickets;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = ['subject','description','priority'];

    public function replies()
    {
        return $this->hasMany(RepliesTickets::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
