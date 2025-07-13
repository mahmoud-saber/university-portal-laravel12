<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grade';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'student_id',
        'course_id',
        'grade',
    ];

    // تحديد الحقول التي يتم التعامل معها كتواريخ
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // العلاقات

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
