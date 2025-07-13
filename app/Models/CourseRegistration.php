<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
    ];

    /**
     * Get the course for this registration.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the student for this registration.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Optionally: Virtual attribute for grade value (if needed in controller/view).
     */
    public $grade_value;
}
