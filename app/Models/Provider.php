<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Provider extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'provider_countries');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'provider_services');
    }
}
