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
            'name' => 'required|string|min:3',
            'my_class_id' => 'required',
            // 'teacher_id' => 'sometimes|nullable|exists:users,id',
            'subject_id' => 'sometimes|nullable|exists:subjects,id',
            'slug' => 'nullable|string|min:3',
        ];
    }

    public function attributes()
    {
        return  [
            'my_class_id' => 'Class',
            // 'teacher_id' => 'Teacher',
            'subject_id' => 'Subject',
            'slug' => 'Short Name',
        ];
    }

    protected function getValidatorInstance()
    {
        $input = $this->all();

        // $input['teacher_id'] = $input['teacher_id'] ? Qs::decodeHash($input['teacher_id']) : NULL;
        $input['subject_id'] = $input['subject_id'] ? Qs::decodeHash($input['subject_id']) : NULL;

        $this->getInputSource()->replace($input);

        return parent::getValidatorInstance();
    }
}
