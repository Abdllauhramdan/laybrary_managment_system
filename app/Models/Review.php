<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['content', 'reviewable_id', 'reviewable_type'];

    // علاقة polymorphic
    public function reviewable()
    {
        return $this->morphTo();
    }

    // ربط المراجعة بالعميل
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
