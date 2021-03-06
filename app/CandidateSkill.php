<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateSkill extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function skills() {
        return $this->hasMany('App\CandidateSkill');
    }
}
