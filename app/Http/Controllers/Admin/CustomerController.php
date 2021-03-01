<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Validator;
use App\Http\Requests\CustomerRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Traits\RedirectAfterSubmit;

class CustomerController extends Controller
{
    use RedirectAfterSubmit;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $name ='admin.customers';
    protected $view ='admin.customers';
    protected $limit = 5;
    
  
    public function index(Request $request)
    { 
        $this->setRedirectLink($request);
        $data['customers'] = Customer::orderBy('id', 'asc')->paginate($this->limit);
        $data['counts'] =Customer::all()->count();
        $data['name']  = $this->name;
        return view($this->view .'.index',$data)->withController($this);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['name']= $this->name;
       
        return view($this->view.'.create',$data)->withController($this);
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
        
       return  redirect()->to($this->getRedirectLink())->with('success', "Khách hàng đã thêm thành công");
       
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
    public function edit(Request $request, $id)
    {   
       
        $data['customer'] = Customer::find($id);
        $data['name']   = $this->name;
        
       // dd(url()->previous());
        return view($this->view.".edit",$data);//->withController(url()->previous());  
        
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
       // return redirect()->url()->previous();
       
        return redirect()->to($this->getRedirectLink())->with('sucess','Lưu dữ liệu thành công!');
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
        return  redirect()->to($this->getRedirectLink())->with('success', 'Customer Deleted Successfully');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $data['customers'] = Customer::query()->where('first_name', 'LIKE', "%{$search}%")
        ->orWhere('last_name', 'LIKE', "%{$search}%")->orWhere('birthday', 'LIKE', "%{$search}%")
        ->orWhere('gender', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%")
        ->orWhere('gender', 'address', "%{$search}%")->orWhere('gender', 'active', "%{$search}%")
        ->paginate($this->limit);
        $data['customers']->appends(['search' => $search]);
        $data['counts'] =session('counts',$data['customers']->count());
        $data['name']  = $this->name;
        $data['link'] =url()->full();
      //  dd($data['customers']->url(url()->full()));
        return view($this->view .'.index',$data)->withController($this);
    }
}
