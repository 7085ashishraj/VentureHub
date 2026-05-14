<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ventureRoom() {
        return $this->belongsTo(VentureRoom::class);
    }

    public function assignee() {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
