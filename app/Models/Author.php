<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'surname'
    ];

    public function books() { //trazim u bazi sve knjige gde je autor_id isti kao ta odredjena instanca autora
        return $this->hasMany(Book::class);
    }
}