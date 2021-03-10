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
  
    public $name ='admin.customers';

    public $view ='admin.customers';
   
    public function index(Request $request)
    { 
        $this->setRedirectLink($request);

        $list = Customer::query();

        $list->when( request('q') !== null, function ($query) {
            $query->where(function ($query){
                $query->where('first_name', 'LIKE', '%' . request('q') . '%')
                    ->orWhere('last_name', 'LIKE', '%' . request('q') . '%')
                    ->orWhere('email', 'LIKE', '%' . request('q') . '%')
                    ->orwhere('phone', 'LIKE', '%' . request('q') . '%');
            });            
        })->when( request('gender') !== null, function ($query) {
            $query->where('gender', request('gender'));
        });

        $list = $list->latest()->paginate( request('pageSize', 5) )->withQueryString();

        return view($this->view .'.index', compact('list'))->withController($this);
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

    public function update(CustomerRequest $request, Customer $customer)
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
}
