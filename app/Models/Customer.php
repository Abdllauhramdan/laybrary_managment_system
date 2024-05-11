<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'password'];

    // فرضياً يمكن للعميل أن يكتب مراجعات
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
