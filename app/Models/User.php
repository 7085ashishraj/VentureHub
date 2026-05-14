<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'skills',
        'profile_image',
        'linkedin',
        'github',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }
    
    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function skills() {
        return $this->belongsToMany(Skill::class, 'user_skill')->withPivot('proficiency')->withTimestamps();
    }

    public function needs() {
        return $this->belongsToMany(Skill::class, 'user_need')->withPivot('description')->withTimestamps();
    }

    public function ventureRoomsCreated() {
        return $this->hasMany(VentureRoom::class, 'creator_id');
    }

    public function roomMemberships() {
        return $this->hasMany(RoomMember::class);
    }

    public function pitches() {
        return $this->hasMany(Pitch::class);
    }

    public function connections() {
        return $this->hasMany(Connection::class, 'requester_id')->orWhere('recipient_id', $this->id);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
        ];
    }

    public function endorsementsReceived() {
        return $this->hasMany(SkillEndorsement::class, 'endorsee_id');
    }

    public function endorsementsGiven() {
        return $this->hasMany(SkillEndorsement::class, 'endorser_id');
    }
}
