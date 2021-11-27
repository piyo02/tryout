<?php

namespace App\Models;

use App\Models\Tryout;
use App\Models\Variation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function variation() {
        return $this->belongsTo(Variation::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function tryouts() {
        return $this->hasMany(Tryout::class);
    }
}
