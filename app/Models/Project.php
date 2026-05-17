<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ventureStage() {
        return $this->belongsTo(VentureStage::class);
    }

    public function ventureRooms() {
        return $this->hasMany(VentureRoom::class);
    }

    public function joinedUsers() {
        return $this->belongsToMany(User::class, 'project_user')->withTimestamps();
    }
}
