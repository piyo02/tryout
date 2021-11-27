<?php

namespace App\Models;

use App\Models\Worksheet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResultWorksheet extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function worksheet() {
        return $this->belongsTo(Worksheet::class);
    }
}
