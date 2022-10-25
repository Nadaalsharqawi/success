<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reject extends Model
{
    use HasFactory;

    protected $fillable = ['reason', 'description', 'order_id','provider_id'];

      public function providers(): BelongsTo
    {
        return $this->belongsTo(Provider::class,'provider_id');
    }

      public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class,'order_id');
    }
  
}
