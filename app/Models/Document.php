<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_path',
        'file_type',
        'original_name',
    ];

    public $timestamps = true;

    // علاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
