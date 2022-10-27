<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name_ar', 'name_en'];
    protected $appends = ['name'];
    
    public function getNameAttribute()
    {
        if (app()->isLocale('ar')) {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }
}
