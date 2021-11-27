<?php

namespace App\Models;

use App\Models\Option;
use App\Models\Question;
use App\Models\Worksheet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAnswer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function worksheet() {
        return $this->belongsTo(Worksheet::class);
    }

    public function option() {
        return $this->belongsTo(Option::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
