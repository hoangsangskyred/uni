<div class="modal fade" id="deleteRow{{$needle->id}}Modal" tabindex="-1" aria-labelledby="row{{$needle->id}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route($controller->name . '.destroy',[$needle->id])}}" method="post" novalidate>
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="row{{$needle->id}}ModalLabel">Xóa mẫu tin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <p>Bạn đang muốn xóa dự án <strong class="text-primary">{{$needle->title}}</strong></p>
                    <p>Bạn có muốn tiếp tục?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                    <button type="submit" class="btn btn-danger">Có</button>
                </div>
            </form>
        </div>
    </div>
</div>
