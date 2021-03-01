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
        return [
             'first_name' => 'required',
             'last_name' => 'required',
             'birthday' =>'required|before:today',
             'email' =>  'required|regex:/(.+)@(.+)\.(.+)/i|email|unique:customers',
             'phone' =>'required|regex:/(0)[0-9]/|digits_between:10,15'
            
        ];  
    }

    public function messages() 
{
       return [
        
            'first_name.required' => 'Vui lòng nhập FirstName',
            'last_name.required' => 'Vui lòng nhập LastName',
            'birthday.required' =>'Vui lòng nhập ngày sinh',
            'birthday.before' =>'Ngày sinh không hợp lệ',
            'email.unique'  =>'Email đã tồn tại',
            'email.regex' =>'Email không hợp lệ',
            'phone.required' =>'Vui lòng nhập số điện thoại',
            'phone.regex' =>'Số điện thoại không hợp lệ',
            'phone.digits_between'=>'Số điện thoại không hợp lệ',
             
            
        ];
}

}
