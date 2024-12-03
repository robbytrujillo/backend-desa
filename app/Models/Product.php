<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'image',
        'owner',
        'price',
        'phone',
        'address',
    ];
}
