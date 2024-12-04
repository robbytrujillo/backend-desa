<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// import Eloquent Attribute
use Illuminate\Database\Eloquent\Casts\Attribute;

class Aparatur extends Model
{
    //
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'role',
        'image'
    ];

    /**
     * image
     * 
     * @return Attribute
     */
    protected function image(): Attribute { // membuat method baru dengan nama image
        return Attribute::make(
            get: fn ($image) => url('/storage/aparaturs/' . $image), // melakukan return dengan path dimana file image itu berada.
        );
    }
}
