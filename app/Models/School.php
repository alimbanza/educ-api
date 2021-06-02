<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'name',
        'logo',
        'email',
        'phone',
        'adress',
        'matricule',
        'convention_id',
        'category_school_id',
    ];

    /**
     * Get the categorySchool that owns the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorySchool()
    {
        return $this->belongsTo(CategorySchool::class);
    }

    /**
     * Get the convention that owns the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function convention()
    {
        return $this->belongsTo(Convention::class);
    }

    /**
     * The options that belong to the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function options()
    {
        return $this->belongsToMany(Option::class, 'option_school');
    }

    /**
     * Get all of the classes for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function classes()
    {
        return $this->hasManyThrough(Classe::class, OptionSchool::class);
    }

    /**
     * Get all of the responsibles for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responsibles()
    {
        return $this->hasMany(ResponsibleSchool::class);
    }
}
