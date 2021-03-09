<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ArticleCategoryRequest extends FormRequest
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
            'display_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'display_name.required' => 'Vui lòng cho biết Tên hiển thị',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'display_name' => Str::title($this->display_name)
        ]);
    }
}
