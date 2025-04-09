<?php

namespace App\Models\Priority;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priority';
    protected $fillable = ['priority'];

    public function tickets()
    {
        return $this->hasMany(Priority::class);
    }
}
