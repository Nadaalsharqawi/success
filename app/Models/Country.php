<?php

namespace App\Models;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name_ar', 'name_en', 'code', 'short_code', 'status', 'logo','setting_id'];
    protected $hidden = ['name_ar', 'name_en', 'created_at', 'updated_at', 'deleted_at'];
    protected $date = ['deleted_at'];
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if (app()->isLocale('ar')) {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function universities()
    {
        return $this->hasMany(University::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_users');
    }

    public function setting(): BelongsTo
    {
        return $this->belongsTo(Setting::class);
    }

    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'membership_countries');
    }
}
