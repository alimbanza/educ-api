<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'name',
        'section_id'
    ];

    /**
     * Get the section that owns the Option
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * The schools that belong to the Option
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function schools()
    {
        return $this->belongsToMany(School::class, 'option_school');
    }
}
