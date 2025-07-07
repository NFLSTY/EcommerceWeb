<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}