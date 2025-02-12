<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'release_date',
        'description',
        'isbn',
        'format',
        'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

}