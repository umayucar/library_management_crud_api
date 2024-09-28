<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Versionable\VersionableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Author extends Model implements HasMedia
{
    use HasFactory, VersionableTrait, SoftDeletes, InteractsWithMedia;

    // Define fillable attributes for mass assignment
    protected $fillable = ['name', 'surname', 'biography'];

    // Automatically make all fillable attributes versionable
    protected $versionable = ['*'];

    /**
    *  An author can have multiple books associated with them.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function books()
    {
        return $this->hasMany(Book::class); // Return the relationship definition
    }

}
