<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'company';

    protected $fillable = [
        'company_name', 'simple_name'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function user() {
        return $this->hasMany('App\User');
    }
}
