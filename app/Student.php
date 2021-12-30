<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function studentcourses()
    {
        return $this->hasMany('App\StudentCourse');
    }
    public function programme()
    {
        return $this->belongsTo('App\Programme')->withDefault();
    }
}
