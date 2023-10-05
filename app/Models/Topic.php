<?php

namespace App\Models;

use App\User;
use Eloquent;

class Topic extends Eloquent
{
    // protected $fillable = ['name', 'my_class_id', 'teacher_id', 'slug'];
    protected $fillable = ['name', 'my_class_id', 'slug', 'subject_id'];

    public function my_class()
    {
        return $this->belongsTo(MyClass::class);
    }

    // public function teacher()
    // {
    //     return $this->belongsTo(User::class, 'teacher_id');
    // }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
