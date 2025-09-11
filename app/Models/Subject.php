<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 *
 * @property $id
 * @property $degree_program_id
 * @property $code
 * @property $name
 * @property $credits
 * @property $semester
 * @property $created_at
 * @property $updated_at
 *
 * @property DegreeProgram $degreeProgram
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Subject extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['degree_program_id', 'code', 'name', 'credits', 'semester'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function degreeProgram()
    {
        return $this->belongsTo(\App\Models\DegreeProgram::class, 'degree_program_id', 'id');
    }
    
}
