<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalSkills extends Model
{
    //
    protected $table = "additional_skills";
	protected $primaryKey  = 'recruiter_id';
    protected $fillable = [
        "recruiter_id", "research_exp", "industry_exp", "leadership", "gpa_required", "gpa_threshold"
    ];
}
