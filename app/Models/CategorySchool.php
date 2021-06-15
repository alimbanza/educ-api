<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategorySchool extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'name'
    ];

    /**
     * Get all of the schools for the CategorySchool
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
