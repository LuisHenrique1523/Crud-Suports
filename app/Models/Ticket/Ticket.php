<?php

namespace App\Models\Ticket;

use App\Models\Category\category;
use App\Models\Priority\Priority;
use App\Models\Status\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = ['subject','description','priority'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
