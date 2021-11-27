<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tryout;
use App\Models\StudentAnswer;
use App\Models\ResultWorksheet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Worksheet extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function student_answers() {
        return $this->hasMany(StudentAnswer::class);
    }

    public function tryout() {
        return $this->belongsTo(Tryout::class);
    }

    public function results() {
        return $this->hasMany(ResultWorksheet::class);
    }
}
