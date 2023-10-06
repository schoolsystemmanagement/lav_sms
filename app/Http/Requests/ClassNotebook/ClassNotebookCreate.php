<?php

namespace App\Http\Requests\ClassNotebook;

use App\Helpers\Qs;
use Illuminate\Foundation\Http\FormRequest;

class ClassNotebookCreate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'topic_id' => 'nullable|exists:topics,id',
            'section_id' => 'required|exists:sections,id',
            // 'teacher_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'entryType' => 'required|in:course,assignment,quizz',
        ];
    }

    public function attributes()
    {
        return  [
            'topic_id' => 'Topic',
            'section_id' => 'Section',
            // 'teacher_id' => 'Teacher',
            'subject_id' => 'Subject',
            'date' => 'Date',
            'title' => 'Titre',
            'description' => 'Description',
            'entryType' => 'Entry Type',
        ];
    }

    public function validated()
    {
        $data = parent::validated();

        // Set 'date' to now if it's not provided
        if (!isset($data['date'])) {
            $data['date'] = now();
        }

        //$subject->my_class_id and $section->my_class_id should be the same
        $section = Section::find($data['section_id']);
        $subject = Subject::find($data['subject_id']);
        // Check if 'my_class_id' matches between 'Subject' and 'Section'
        if ($subject->my_class_id != $section->my_class_id) {
            // You can handle validation errors here.
            // For example, you can throw a validation exception.
            throw new \Illuminate\Validation\ValidationException('my_class_id mismatch');
        }


        // make sure 'my_class_id' match if 'topic_id' is provided
        if (isset($data['topic_id'])) {
            $topic = Topic::find($data['topic_id']);
            //$topic->my_class_id and $subject->my_class_id should be the same
            // validation ...
            if ($topic->my_class_id != $section->my_class_id) {
                // You can handle validation errors here.
                // For example, you can throw a validation exception.
                throw new \Illuminate\Validation\ValidationException('my_class_id mismatch');
            }
        }


        // make sure 'my_class_id' match if 'topic_id' is provided
        if (isset($data['topic_id'])) {
            $topic = Topic::find($data['topic_id']);
            //$topic->subject_id and $subject->id should be the same
            // validation ...
            if ($topic->subject_id != $subject->id) {
                // You can handle validation errors here.
                // For example, you can throw a validation exception.
                throw new \Illuminate\Validation\ValidationException('subject_id mismatch');
            }
        }

        // Remove 'creationDate' from the validated data
        unset($data['creationDate']);

        return $data;
    }

    protected function getValidatorInstance()
    {
        $input = $this->all();

        $input['topic_id'] = $input['topic_id'] ? Qs::decodeHash($input['topic_id']) : NULL;
        $input['section_id'] = $input['section_id'] ? Qs::decodeHash($input['section_id']) : NULL;
        $input['subject_id'] = $input['subject_id'] ? Qs::decodeHash($input['subject_id']) : NULL;

        $this->getInputSource()->replace($input);

        return parent::getValidatorInstance();
    }
}
