<?php

namespace App\Models;

use App\Models\User;
use App\Models\Option;
use App\Models\Variation;
use App\Models\Collection;
use App\Models\StudentAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class);
    }

    public function student_answers()
    {
        return $this->hasMany(StudentAnswer::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function childs()
    {
        return $this->hasMany(Question::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Question::class, 'parent_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($question){
            $question->options()->delete();
        });
    }
}
