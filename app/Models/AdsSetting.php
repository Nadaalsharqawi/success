<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class AdsSetting extends Model
{
    use HasFactory;

     protected $fillable = ['country_id','duration_status','date_publication','duration','price'];

    public function countries(): BelongsTo
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
