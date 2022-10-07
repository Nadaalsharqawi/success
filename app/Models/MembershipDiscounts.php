<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembershipDiscounts extends Model
{
    use HasFactory;
    protected $fillable = ['discount', 'start_date', 'end_date', 'membership_id', 'limit_for_user', 'type', 'max_discount', 'limit_use'];
    protected $hidden = ['created_at', 'updated_at'];

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }
}
