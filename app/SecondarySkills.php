<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondarySkills extends Model
{
    //
    protected $table = "secondary_skills";

    protected $fillable = [
        "recruiter_id", "skill"
    ];
}
