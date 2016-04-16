<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    //
    protected $table = "platform";

    protected $fillable = [
        "recruiter_id", "platform"
    ];
}
