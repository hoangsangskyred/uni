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
  
    protected $name ='admin.customers';

    protected $view ='admin.customers';

    protected $pageSize = 2;
   
    public function index(Request $request)
    { 
        $this->setRedirectLink($request);

        $data['customers'] = Customer::orderBy('id', 'asc')->paginate($this->pageSize);

        $data['counts'] =Customer::all()->count();

        $data['name']  = $this->name;

        $data['gender'] = $request->input('gender');

        $data['search'] = $request->session()->get('q');
        
        return view($this->view .'.index',$data)->withController($this);
    
    }

    
    public function create(Request $request)
    {
        $data['name']= $this->name;
        
        return view($this->view.'.create',$data)->withController($this);
    }

    
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

   
    public function edit(Request $request, $id)
    {   
       
        $data['customer'] = Customer::find($id);

        $data['name']   = $this->name;
        
        return view($this->view.".edit",$data);//->withController(url()->previous());  
        
    }


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
      
        return redirect()->to($this->getRedirectLink())->with('sucess','Lưu dữ liệu thành công!');

    }

   
    public function destroy($id)
    {
        $customer = Customer::find($id);

        $customer ->delete();

        return  redirect()->to($this->getRedirectLink())->with('success', 'Customer Deleted Successfully');

    }

    public function search(Request $request)
    {  
        
        $search = $request->input('q');

        $gender =$request->input('gender');
        
        if ( $search=='' ) {

            if ( $gender==null ) {
                
                $data['customers'] = Customer::query()->where(function ($query) use ($search) {
                    
                    $query->where('first_name', 'LIKE', "%{$search}%")
                        ->orwhere('last_name','LIKE',"%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orwhere('phone','LIKE',"%{$search}%");

                })->paginate($this->pageSize);

              $data['customers']->appends(['q' => $search]);

            } elseif ( $gender == '1' ) {

                $data['customers'] = Customer::query()->where('gender',1)->paginate($this->pageSize);

                $data['customers']->appends(['gender'=>'1','q' => $search]);

            } else {

                $data['customers'] = Customer::query()->where('gender',0)->paginate($this->pageSize);

                $data['customers']->appends(['gender'=>'0','q' => $search]);

            }

        } else {
            
            if( $gender == null ) {

                $data['customers'] = Customer::query()->where(function ($query) use ($search) {

                    $query->where( 'first_name', 'LIKE', "%{$search}%" )
                        ->orwhere( 'last_name', 'LIKE', "%{$search}%" )
                        ->orWhere( 'email', 'LIKE', "%{$search}%" )
                        ->orwhere( 'phone', 'LIKE', "%{$search}%" );

                })->paginate( $this->pageSize );
                
                $data['customers']->appends( ['q' => $search] );

            } elseif ( $gender == '1' ) {

                $data['customers']= Customer::query()->where('gender', '=', '1')->where( function ( $query ) use ( $search ) {

                    $query->where('first_name', 'LIKE', "%{$search}%")
                        ->orwhere('last_name','LIKE',"%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orwhere('phone','LIKE',"%{$search}%");
                
                })->paginate( $this->pageSize );

                $data['customers']->appends( ['gender'=>'1', 'q' => $search] );

            } else {
              
                $data['customers']= Customer::query()->where('gender', '=', '0')->where( function ( $query ) use ( $search ) {
                    
                    $query->where('first_name', 'LIKE', "%{$search}%")
                        ->orwhere('last_name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orwhere('phone', 'LIKE', "%{$search}%");
                    
                })->paginate($this->pageSize);
                
                $data['customers']->appends( ['gender'=>'0','q' => $search] );
             
            }
          
      }

       $data['counts'] =Customer::all()->count();

       $data['name']  = $this->name;

       $data['gender'] =$request->input('gender');

       $data['search']=  $request->input('q'); 

       return view($this->view .'.index',$data)->withController($this);
     
    }
}
