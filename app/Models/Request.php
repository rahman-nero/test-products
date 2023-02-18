<?php

namespace App\Models;

use App\Http\Enums\ProductQuality;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'consumer_id',
        'product_title',
        'min_price',
        'max_price',
        'product_quality',
    ];

    protected $casts = [
        'product_quality' => ProductQuality::class
    ];
}
