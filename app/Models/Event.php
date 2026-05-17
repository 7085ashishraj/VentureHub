<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function organizer() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ventureRoom() {
        return $this->belongsTo(VentureRoom::class);
    }

    public function tickets() {
        return $this->hasMany(EventTicket::class);
    }
}
