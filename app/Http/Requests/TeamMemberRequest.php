<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class TeamMemberRequest extends FormRequest
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
            'full_name' => 'required',
            'title' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Vui lòng cho biết Tên hiển thị',
            'title.required' => 'Vui lòng cho biết Chức vụ',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'full_name' => Str::title($this->full_name),
            'title' => Str::title($this->title),
            'show' => $this->has('show') ? 'Y' : 'N',
        ]);
    }
}
