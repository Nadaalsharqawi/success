<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'image','date_publication','date_expiry','provider_id','type'];

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'ads_countries');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_ads');
    }

      public function providers(): BelongsTo
    {
        return $this->belongsTo(Provider::class,'provider_id');
    }
}
