<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function usersWithSkill() {
        return $this->belongsToMany(User::class, 'user_skill')->withPivot('proficiency')->withTimestamps();
    }

    public function usersWithNeed() {
        return $this->belongsToMany(User::class, 'user_need')->withPivot('description')->withTimestamps();
    }
}
