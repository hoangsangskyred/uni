<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class UserRequest extends FormRequest
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
        $rule = [
            'name' => 'required',
            'email' =>  'required|regex:/(.+)@(.+)\.(.+)/i|email|unique:customers',
            'role' => 'required',
        ];
        
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            
            $rule['email'] = 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.$this->user['id'];
        }

        return $rule;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng cho biết Tên hiển thị',
            'email.required' => 'Vui lòng nhập địa chỉ email',
            'email.regex' =>'Email không hợp lệ',
            'email.unique'=> 'Email đã tồn tại',
            'role.required' => 'Vui lòng chọn vai trò của tài khoản này.',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => Str::title($this->name),
            'password'=>bcrypt($this->password)
        ]);
    }
}
