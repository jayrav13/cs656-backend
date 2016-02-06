<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'active', 'company_id', 'twitter', 'linkedin', 'website', 'resume' 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'user_token'
    ];

    protected $guarded = [
        'password', 'remember_token', 'user_token', 'id', 'created_at', 'updated_at'
    ];

    public function company() {
        return $this->belongsTo('App\Company', 'company_id');
    }

    public function recruitersConnected() {
        return $this->belongsToMany('App\User', 'student_recruiter', 'student_id', 'recruiter_id');
    }

    public function studentsConnected() {
        return $this->belongsToMany('App\User', 'student_recruiter', 'recruiter_id', 'student_id');
    }

}
