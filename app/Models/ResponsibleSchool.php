<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsibleSchool extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'person_id',
        'responsability_school_id',
    ];

    /**
     * Get the person that owns the ResponsibleSchool
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Get the school that owns the ResponsibleSchool
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the responsability that owns the ResponsibleSchool
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function responsability()
    {
        return $this->belongsTo(ResponsabilitiesSchool::class);
    }
}
