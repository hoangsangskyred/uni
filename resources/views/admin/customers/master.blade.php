<div class="card-body">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th width="100px">First Name</th>
            <th width="100px">Last Name</th>
            <th width="100px">Birthday</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Status</th>
            <th width="70px">Action</th>     
        </tr>
        <tbody>
        @if($list->count() > 0)    
        @foreach($list as $customer)
            <tr>
                <td>{{$customer->id}}</td>
                <td>{{$customer->first_name}}</td>
                <td>{{$customer->last_name}}</td>
                <td>{{$customer->birthday->format('d-m-Y')}}</td>
                <td>{{$customer->gender==1 ?"nam":"nữ"}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->address}}</td>
                <td>{{$customer->active== 1 ?"active" :"disable" }}</td>
                <td><a href="{{ route($controller->name.'.edit', $customer->id) }}" title="edit"><i class="fas fa-edit  fa-sm"></i></a>
                       <!-- Button trigger modal 5-->
                     <a  href ="#" data-bs-toggle="modal" data-bs-target="#customersModal{{$customer->id}}"  title="delete" class="text-danger fa-sm px-2"> <i class="fas fa-times-circle"></i></a>
                      <!--Modal--> 
                    <div class="modal fade" id="customersModal{{$customer->id}}" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="{{ route($controller->name.'.destroy', $customer->id) }}" method="post">
                                 @csrf
                                     @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="customersModalLabel">Xóa Khách Hàng</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <p>Tên Khách Hàng : <strong class="text-primary text-capitalize">{{($customer->last_name)}}&nbsp;{{$customer->first_name}}</strong></p>
                                        <p>Các dữ liệu liên quan có thể bị xóa và không thể khôi phục lại.Bạn có muốn tiếp tục?</p>
                                    </div>
                                    <div class="modal-footer">
                                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                         <button type="submit" class="btn btn-danger">Có</button> 
                                    </div>
                                </form>  
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            @else 
            <tr>
                <td colspan="4">
                    <div class="alert alert-danger mb-0"><i class="fas fa-exclamation-circle"></i> Không có khách hàng nào</div>
                </td>
            </tr>
         @endif
        </tbody>
        </thead>
     </table>
</div>
<div class="pagination justify-content-center">
    {{$list->links()}}   
 </div>
