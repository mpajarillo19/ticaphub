<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicapRubric extends Model
{
    use HasFactory;

    protected $table = 'ticap_rubrics';
    protected $fillable = [
        'name',
        'path',
        'ticap_id'
    ];

    public function ticap(){
        return $this->belongsTo(Ticap::class, 'ticap_id', 'id');
    }
}
