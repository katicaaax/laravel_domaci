<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'published_at',
        'age',
        'author_id',
        'category_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class); //pretraga usera po id
    }

    public function author() {
        return $this->belongsTo(Author::class); //pretraga autora
    }

    public function category() {
        return $this->belongsTo(Category::class); //pretraga kategorija
    }
}

