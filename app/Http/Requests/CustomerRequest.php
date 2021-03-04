<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' =>'required|before:today',
            'email' =>  'required|regex:/(.+)@(.+)\.(.+)/i|email|unique:customers',
            'phone' =>'required|regex:/(0)[0-9]/|digits_between:10,15',
        ];
        
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            
            $rule['email'] = 'required|regex:/(.+)@(.+)\.(.+)/i|unique:customers,email,'.$this->customer['id'];
        }

        return $rule;
      
    }

    public function messages() 
{
       return [
            'first_name.required'=>'Vui lòng nhập Tên',
            'last_name.required' =>'Vui lòng nhập Họ và tên đệm',
            'birthday.required'  => 'Vui lòng nhập ngày đúng định dạng',
            'birthday.before' =>'Ngày sinh không hợp lệ',
            'email.required'  =>'Vui lòng nhập email',
            'email.unique'  =>'Email đã tồn tại',
            'email.regex' =>'Email không hợp lệ',
            'phone.required'=>'Vui lòng nhập số điện thoại',
            'phone.regex'=>'Số điện thoại không hợp lệ',
            'phone.digits_between'=>'Số điện thoại không hợp lệ'
        ];
}

}
