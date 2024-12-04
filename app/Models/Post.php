<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// import Eloquent Attribute
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    //
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'category_id', 'user_id', 'content', 'image'
    ];

    // Posts belongs to Categories
    /**
     * category
     * 
     * @return void
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Post belongs to user
    /**
     * user
     * 
     * @return void
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * image
     * 
     * @return Attribute
     */
    protected function image(): Attribute { // membuat method baru bernama image
        return Attribute::make(
            get: fn ($image) => url('/storage/posts/' . $image), // melakukan return dengan path
        );
    }
}
