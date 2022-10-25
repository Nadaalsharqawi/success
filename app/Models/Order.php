<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Provider;

class Order extends Model
{
    use HasFactory;

    protected $fillable = 
    ['name_ar', 'name_en', 'user_id','provider_id','status', 'status_order', 'image','provider_name',
        'service_name', 'expertise_name', 'pages_number','description','price', 'old_price',
         'delivery_date','publish_date', 'university', 'year','user_name','user_phone'];

    public function getNameAttribute()
        {
            if (app()->isLocale('ar')) {
                return $this->name_ar;
            } else {
                return $this->name_en;
            }
        }

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class ,'user_id');
    }

      public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class ,'user_id');
    }
}
