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

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class ,'user_id');
    }

      public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class ,'user_id');
    }
}
