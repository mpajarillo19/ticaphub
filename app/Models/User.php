<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'student_number',
        'password',
        'ticap_id',
        'school_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function school() {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
    public function userSpecialization() {
        return $this->hasOne(UserSpecialization::class, 'user_id', 'id');
    }
    public function candidate() {
        return $this->hasOne(Candidate::class, 'user_id', 'id');
    }
    public function officer() {
        return $this->hasOne(Officer::class, 'user_id', 'id');
    }
    public function votes() {
        return $this->hasMany(Vote::class, 'user_id', 'id');
    }
    public function userGroup() {
        return $this->hasOne(UserGroup::class, 'user_id', 'id');
    }
    public function lists() {
        return $this->hasMany(TaskList::class, 'user_id', 'id');
    }
    public function tasks() {
        return $this->belongsToMany(Task::class, 'user_task', 'user_id', 'task_id');
    }
    public function tasksCreated() {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }
    public function activities() {
        return $this->hasMany(Activity::class, 'user_id', 'id');
    }
    public function scopeSearch($query, $term) {
        $term  = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('first_name', 'LIKE', $term)
                ->orWhere('middle_name', 'LIKE', $term)
                ->orWhere('last_name', 'LIKE', $term);
        });
    }
}
