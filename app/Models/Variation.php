<?php

namespace App\Models;

use App\Models\Collection;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function collections() {
        return $this->hasMany(Collection::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
