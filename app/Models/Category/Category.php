<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\Ticket;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category','color'];

    public function tickets()
    {
        return $this->hasMany(Category::class);
    }
}
