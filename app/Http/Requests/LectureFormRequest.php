<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureFormRequest extends FormRequest
{

    /* NOTE: 2 Problems => 1 - premium is passed as a string 2 - video validation doesn't working well



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
            'name' => 'required|min:15|max:191|unique:courses,name,'.$this->id,
            'description' => 'required|max:65535',
            //'video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:20000',
            'episode_number' => 'required|numeric',
            'premium' => 'required'
        ];
    }
}
