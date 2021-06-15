<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commune extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'name',
        'town_id',
    ];

    /**
     * Get the town that owns the Commune
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    /**
     * Get all of the people for the Commune
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
