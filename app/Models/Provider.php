<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Provider extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'facebook',
        'instagram',
        'whatsapp',
        'snap_chat',
    ];
      /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
      protected $casts = [
        'email_verified_at' => 'datetime',
    ];


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

    // public function package()
    // {
    //     return $this->hasMany(Membership::class);
    // }

    public function ad()
    {
        return $this->hasMany(Ads::class);
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
