<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Versionable\VersionableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Book extends Model implements HasMedia
{
    use HasFactory, VersionableTrait, SoftDeletes, InteractsWithMedia;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'author_id',   
        'isbn',    
        'title',         
        'description',   
        'publication_year',
        'publisher',     
        'page_count',      
        'status'           
    ];

    // Automatically make all fillable attributes versionable
    protected $versionable = ['*'];

    /**
    * Each book is associated with one author.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function author()
    {
        return $this->belongsTo(Author::class);  
    }

    /**
    * A book can be found in more than one library.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function library()
    {
        return $this->belongsToMany(Library::class, 'book_library');  
    }
}

