<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ClassNotebook extends Model
{
    // protected $fillable = ['topic_id', 'section_id', 'teacher_id', 'subject_id', 'date', 'title', 'description', 'creationDate', 'entryType'];
    protected $fillable = ['topic_id', 'section_id', 'subject_id', 'date', 'title', 'description', 'creationDate', 'entryType'];

    protected $dates = ['date', 'creationDate'];

    // protected $casts = [
    //     'entryType' => 'enum:course,assignment,quizz',
    // ];



    public function setTopicAttribute($value)
    {
        $this->attributes['topic_id'] = $value ?: null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ?: now();
    }

    public function setCreationDateAttribute($value)
    {
        $this->attributes['creationDate'] = $value ?: now();
    }

    // Add a mutator to validate and set allowed values for entryType
    public function setEntryTypeAttribute($value)
    {
        // Define the allowed values for entryType
        $allowedValues = ['course', 'assignment', 'quizz'];

        // Check if the provided value is in the allowed values array
        if (in_array($value, $allowedValues)) {
            $this->attributes['entryType'] = $value;
        } else {
            // Throw an exception for invalid values
            throw new \InvalidArgumentException("Invalid entryType value: $value. Allowed values are " . implode(', ', $allowedValues));
        }
    }


    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
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
