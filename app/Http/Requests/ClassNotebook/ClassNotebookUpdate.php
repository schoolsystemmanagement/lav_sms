<?php

namespace App\Http\Requests\Topic;

use App\Helpers\Qs;
use Illuminate\Foundation\Http\FormRequest;

class TopicUpdate extends FormRequest
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
            'creationDate' => 'required|date',
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
            'creationDate' => 'Creation Date',
            'entryType' => 'Entry Type',
        ];
    }

    public function validated()
    {
        $data = parent::validated();

        // Remove 'creationDate' from the validated data
        unset($data['creationDate']);

        return $data;
    }


    protected function getValidatorInstance()
    {
        $input = $this->all();

        $input['topic_id'] = $input['topic_id'] ? Qs::decodeHash($input['topic_id']) : NULL;
        $input['section_id'] = $input['section_id'] ? Qs::decodeHash($input['section_id']) : NULL;
        // $input['teacher_id'] = $input['teacher_id'] ? Qs::decodeHash($input['teacher_id']) : NULL;
        $input['subject_id'] = $input['subject_id'] ? Qs::decodeHash($input['subject_id']) : NULL;

        $this->getInputSource()->replace($input);

        return parent::getValidatorInstance();
    }
}
