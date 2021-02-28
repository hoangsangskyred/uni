<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Validator;
use App\Http\Requests\CustomerRequest;
use Illuminate\Validation\Rule;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $name ='admin.customers';
    protected $view ='admin.customers';

    public function index()
    {
        $data['customers'] = Customer::orderBy('id', 'asc')->paginate(5);
        $data['counts'] =Customer::all()->count();
        $data['name']  = $this->name;
        return view($this->view .'.index',$data);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['name']= $this->name;
        return view($this->view.'.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        
        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name  = $request->last_name;
        $customer->email      = $request->email;
        $customer->birthday   = $request->birthday;
        $customer->gender     = $request->gender;
        $customer->phone      = $request->phone;
        $customer->address    = $request->address;
        $customer->active     = $request->status;
        $customer->save();
        
        return redirect()->route($this->view.'.index')->with('success', "Khách hàng đã thêm thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['customer'] = Customer::find($id);
        $data['name']   = $this->name;
        return view($this->view.".edit",$data);  
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        
         $this->validate($request, [
             'first_name' => 'required',
             'last_name' => 'required',
            'birthday' =>'required|date_format:d-m-Y|before:today',
             'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:customers,email,'.$id,
             'phone' =>'required|regex:/(0)[0-9]/|digits_between:10,15',
        ], [
            'first_name.required'=>'Vui lòng nhập Fist Name',
             'last_name.required' =>'Vui lòng nhập Last Name',
             'birthday.required'  => 'Vui lòng nhập ngày đúng định dạng',
             'birthday.before' =>'Ngày sinh không hợp lệ',
             'email.required'  =>'Vui lòng nhập email',
             'email.unique'  =>'Email đã tồn tại',
             'email.regex' =>'Email không hợp lệ',
             'phone.required'=>'Vui lòng nhập số điện thoại',
             'phone.regex'=>'Số điện thoại không hợp lệ',
             'phone.digits_between'=>'Số điện thoại không hợp lệ'

        ]);
      
        $customer = Customer::findOrFail($id);
        $customer->first_name = $request->first_name;
        $customer->last_name  = $request->last_name;
        $customer->birthday   = $request->birthday;
        $customer->gender     = $request->gender;
        $customer->email      = $request->email;
        $customer->phone      = $request->phone;
        $customer->address    = $request->address;
        $customer->active     = $request->status;
        $customer->save();
        return redirect()->route($this->view.'.index')->with('success', "Khách hàng đã cập nhật thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer ->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer Deleted Successfully');
    }
}
