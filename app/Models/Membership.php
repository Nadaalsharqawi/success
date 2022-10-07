<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Membership extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name_membership', 'service_id', 'membership_value', 'eligibility_type'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $date = ['deleted_at'];

    /**
     * Get all of the users for the Membership
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the service that owns the Membership
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'membership_countries');
    }

    public function membershipDiscount(): HasMany
    {
        return $this->hasMany(MembershipDiscounts::class);
    }
}
