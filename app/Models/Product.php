<?php

namespace App\Models;

use App\Http\Enums\ProductQuality;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'seller_id',
        'title',
        'price',
        'quality',
        'created_at'
    ];

    protected $casts = [
        'quality' => ProductQuality::class
    ];

}
