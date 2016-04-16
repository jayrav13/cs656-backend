<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrimarySkills extends Model
{
    //
    protected $table = "primary_skills";

    protected $fillable = [
        "recruiter_id", "skill"
    ];
}
