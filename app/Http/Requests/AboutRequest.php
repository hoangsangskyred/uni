<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng cho biết Tên hiển thị',
            'content.required' => 'Vui lòng cho biết Nội dung bài viết',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'title' => Str::title($this->title)
        ]);
    }
}
