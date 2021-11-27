<?php

namespace App\Models;

use App\Models\Worksheet;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tryout extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function collection() {
        return $this->belongsTo(Collection::class);
    }

    public function worksheets() {
        return $this->hasMany(Worksheet::class);
    }
}
