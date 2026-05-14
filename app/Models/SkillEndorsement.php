<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillEndorsement extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function endorser() {
        return $this->belongsTo(User::class, 'endorser_id');
    }

    public function endorsee() {
        return $this->belongsTo(User::class, 'endorsee_id');
    }

    public function skill() {
        return $this->belongsTo(Skill::class);
    }
}
