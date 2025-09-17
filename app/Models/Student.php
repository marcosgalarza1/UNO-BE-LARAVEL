<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 *
 * @property $id
 * @property $user_id
 * @property $registration
 * @property $degree_program_id
 * @property $semester
 * @property $birth_date
 * @property $gpa
 * @property $created_at
 * @property $updated_at
 *
 * @property DegreeProgram $degreeProgram
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Student extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'registration', 'degree_program_id', 'semester', 'birth_date', 'gpa'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function degreeProgram()
    {
        return $this->belongsTo(\App\Models\DegreeProgram::class, 'degree_program_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
}
