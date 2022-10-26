<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;
use App\Models\Provider;

class PriceOffer extends Model
{
    use HasFactory;

      public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class ,'product_offer_id');
    }

      public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class ,'provider_offer_id');
    }
}
