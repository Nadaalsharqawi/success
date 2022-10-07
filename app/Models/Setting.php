<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'whatsapp', 'terms', 'policy', 'advertising'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get all of the countries for the Setting
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }
}
