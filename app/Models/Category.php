<?php

namespace App\Models;

// import HashFactory
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    
     // 1 data category memiliki banyak data post 
    /**
     * posts
     * 
     * @return void
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }
}
