<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
