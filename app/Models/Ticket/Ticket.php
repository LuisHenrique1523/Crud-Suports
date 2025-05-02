<?php

namespace App\Models\Ticket;

use App\Enums\Priority;
use App\Models\Category\category;
use App\Models\Comemntary\Commentary;
use App\Models\Operation\Operation;
use App\Models\RepliesTickets;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = ['subject','description','priority','status','category_id'];
    protected $casts = [
        'priority' => Priority::class,
    ];
    public function replies()
    {
        return $this->hasMany(RepliesTickets::class,'ticket_id', 'id');
    }
    public function commentaries()
    {
        return $this->hasMany(Commentary::class);
    }
    public function operations()
    {
        return $this->hasMany(Operation::class);
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
