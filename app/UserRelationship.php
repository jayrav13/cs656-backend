<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRelationship extends Model
{
    protected $table = "student_recruiter";

    protected $fillable = [
        "student_id", "recruiter_id"
    ];
}
