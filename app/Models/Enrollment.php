<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Enrollment
 *
 * @property $id
 * @property $student_id
 * @property $subject_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Student $student
 * @property Subject $subject
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Enrollment extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['student_id', 'subject_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_id', 'id');
    }
    
}
