<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Provider;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;
    

    public function getNameAttribute()
        {
            if (app()->isLocale('ar')) {
                return $this->name_ar;
            } else {
                return $this->name_en;
            }
        }

        public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class ,'product_order_id');
    }

      public function user(): BelongsTo
    {
        return $this->belongsTo(User::class ,'user_order_id');
    }

   
}
