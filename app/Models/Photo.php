<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Import Eloquent Photo
use Illuminate\Database\Eloquent\Casts\Attribute;

class Photo extends Model
{
    //
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'image',
        'caption'
    ];

    /**
     * image
     * 
     * @return Attribute
     */
    protected function image(): Attribute {  // membuat method baru dengan nama image
        return Attribute::make(
            get: fn ($image) => url('/storage/photos/' . $image), // melakukan return dengan path dimana file image itu berada.
        );
    }
}
