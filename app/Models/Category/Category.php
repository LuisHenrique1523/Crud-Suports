<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories'; 
    protected $fillable = ['name','color'];

    public function tickets()
    {
        return $this->hasMany(Category::class);
    }
}
