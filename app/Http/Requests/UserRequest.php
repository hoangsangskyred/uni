<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use App\Rules\UserPasswordValidation;
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
            'email' => 'required|email|unique:users',
            'role' =>'required',
            'password' => new UserPasswordValidation,
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
            'email.email' => 'Email không hợp lệ',
            'email.unique'=> 'Email đã tồn tại',
            'email.regex' => 'Email không hợp lệ',
            'role.required' => 'Vui lòng chọn vai trò của tài khoản này.',
            'password.required' => 'Mật khẩu phải có ít nhất 5 ký tự',   
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => Str::title($this->name),
        ]);  
    }
}
