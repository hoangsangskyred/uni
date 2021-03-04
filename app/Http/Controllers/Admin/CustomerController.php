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
        $customer = new Customer(request()->all());
      
        $customer->save();

        return  redirect()->to($this->getRedirectLink())->with('success', "Khách hàng đã thêm thành công");   
    }

   
    public function edit(Request $request, $id)
    {    
        $data['customer'] = Customer::find($id);

        $data['name']   = $this->name;
        
        return view($this->view.".edit",$data)->withController($this);
    }


    public function update(CustomerRequest $request,Customer $customer)
    {
        $customer->update($request->all());
        
        return redirect()->to($this->getRedirectLink())->with('success','Lưu dữ liệu thành công!');
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
