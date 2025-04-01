<?php

namespace App\Models\Status;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'priorities';
    protected $fillable = ['status','color'];

    public function tickets()
    {
        return $this->hasMany(Status::class);
    }
}
