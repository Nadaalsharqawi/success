<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Expertise;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name_ar', 'name_en', 'description','expertise_id'];
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

  public function expertise(): BelongsTo
    {
        return $this->belongsTo(Expertise::class);
    }

     public function provider(): BelongsToMany
    {
        return $this->belongsToMany(Provider::class, 'providers');
    }




}