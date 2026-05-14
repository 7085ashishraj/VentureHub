<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeanCanvas extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ventureRoom() {
        return $this->belongsTo(VentureRoom::class);
    }
}
