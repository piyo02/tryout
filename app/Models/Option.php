<?php

namespace App\Models;

use App\Models\Question;
use App\Models\StudentAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function student_answers() {
        return $this->hasMany(StudentAnswer::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
