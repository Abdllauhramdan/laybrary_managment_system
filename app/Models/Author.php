<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'birthdate'];

    // علاقة many-to-many مع Book
    public function books()
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }

    // علاقة Morph للمراجعات
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
