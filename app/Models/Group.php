<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';
    protected $fillable = [
        'name',
        'specialization_id',
        'ticap_id'
    ];

    public function ticap() {
        return $this->belongsTo(Ticap::class, 'ticap_id', 'id');
    }
    public function groupExhibit() {
        return $this->hasOne(GroupExhibit::class, 'group_id', 'id');
    }
    public function userGroups() {
        return $this->hasMany(UserGroup::class, 'group_id', 'id');
    }
    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
    public function files() {
        return $this->hasMany(GroupFile::class, 'group_id', 'id');
    }
    public function awards() {
        return $this->belongsToMany(Award::class, 'group_award', 'group_id', 'award_id')
            ->withPivot('total_grade');
    }
    public function groupGrades() {
        return $this->hasMany(GroupGrade::class, 'group_id', 'id');
    }
    public function studentChoiceAward() {
        return $this->hasOne(StudentChoiceAward::class, 'group_id', 'id');
    }
    public function studentVotes() {
        return $this->hasMany(StudentChoiceVote::class, 'group_id', 'id');
    }
    public function groupWinners() {
        return $this->hasMany(GroupWinner::class, 'group_id', 'id');
    }
    public function individualWinners() {
        return $this->hasMany(IndividualWinner::class, 'group_id', 'id');
    }
    public function panelistGrades() {
        return $this->hasMany(PanelistGrade::class, 'group_id', 'id');
    }
    public function individualCandidates() {
        return $this->hasMany(IndividualAwardCandidate::class, 'group_id', 'id');
    }
}
