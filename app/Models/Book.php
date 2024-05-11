<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['title', 'year_published'];

    // علاقة many-to-many مع Author
    public function authors()
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }

    // علاقة Morph للمراجعات
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
