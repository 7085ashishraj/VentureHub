<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentureRoom extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function ventureStage() {
        return $this->belongsTo(VentureStage::class);
    }

    public function members() {
        return $this->hasMany(RoomMember::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public function leanCanvas() {
        return $this->hasOne(LeanCanvas::class);
    }

    public function milestones() {
        return $this->hasMany(Milestone::class);
    }

    public function sweatEquityTasks() {
        return $this->hasMany(SweatEquityTask::class);
    }
}
