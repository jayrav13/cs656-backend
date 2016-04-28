<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MLRank extends Model
{
    //
    protected $connection = 'ML_mysql';
    protected $table = 'ml_rank';
    protected $fillable = [
        'recruiter_id', 'rank_id'
    ];
}
