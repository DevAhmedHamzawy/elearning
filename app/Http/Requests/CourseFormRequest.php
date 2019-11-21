<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'category_id' => 'required',
            //'name' => 'required|min:50|max:191|unique:courses,name,'.$this->id,
            'name' => 'required',
            'description' => 'required|min:50|max:65535',
            'visible' => 'boolean',
            'thumb' => 'required|image|mimes:jpeg,bmp,png,jpg',
            'price' => 'required|numeric',
            'language' => 'required|string',
            'faq' => 'required|min:50|max:4294977295',
            'what_will_students_learn' => 'required|min:50|max:4294977295',
            'target_students' => 'required|min:50|max:4294977295',
            'requirements' => 'required|min:50|max:4294977295',
            'video' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'hours_number' => 'required|numeric'

        ];
    }
}
