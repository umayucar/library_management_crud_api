<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = ['name', 'location'];

    /**
    *  A library can have multiple books.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_library');
    }

    
}
