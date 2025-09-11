<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DegreeProgram
 *
 * @property $id
 * @property $code
 * @property $name
 * @property $faculty_id
 * @property $institution
 * @property $created_at
 * @property $updated_at
 *
 * @property Faculty $faculty
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DegreeProgram extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['code', 'name', 'faculty_id', 'institution'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faculty()
    {
        return $this->belongsTo(\App\Models\Faculty::class, 'faculty_id', 'id');
    }
    
}
