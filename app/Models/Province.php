<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the towns for the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function towns()
    {
        return $this->hasMany(Town::class);
    }

    /**
     * Get all of the communes for the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function communes()
    {
        return $this->hasManyThrough(Commune::class, Town::class);
    }
}
