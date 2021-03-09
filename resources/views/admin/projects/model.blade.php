<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="form-floating mb-3">
            <input type="text" class="form-control text-capitalize" id="title" name="title" placeholder="Tên hiển thị" value="{{old('title', $needle->title)}}" required
                   autofocus>
            <label for="title">Tên hiển thị</label>
            <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-8">
                <div class="form-floating">
                    <select class="form-select" id="category" name="project_category_id"  required>
                        <option value="">Chọn chủ đề</option>
                        @foreach(\App\Models\ProjectCategory::orderBy('display_name')->get() as $projectCategory)
                            <option value="{{$projectCategory->id}}" {{old('project_category_id', $needle->project_category_id)==$projectCategory->id?'selected':''}}>{{$projectCategory->display_name}}</option>
                        @endforeach
                    </select>
                    <label for="category">Chủ đề</label>
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle">Vui lòng chọn chủ đề</i></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show" id="showCheck" {{old('show', $needle->show)=='Y'?'checked':''}}>
                    <label class="form-check-label" for="showCheck">
                        Hiển thị
                    </label>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <button type="button" id="lfm" data-input="avatarPath" class="btn btn-outline-secondary">
                <i class="fas fa-photo"></i> Chọn hình
            </button>
            <input id="avatarPath" class="form-control" type="text" name="avatar_path" value="{{old('avatar_path', $needle->avatar_path)}}" placeholder="Chọn hình đại diện cho dự án">
        </div>

        <div class="row">
            <div class="col-md-12">
                <label>Giới thiệu dự án</label>
                <textarea id="content" name="content" class="form-control" required>{{old('content', $needle->content)}}</textarea>
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle"></i> Không được rỗng
                </div>
            </div>
        </div>
    </div>
</div>

@push('extra-scripts')
    <script src="/public/plugins/ckeditor4/ckeditor.js"></script>
    <script>
        (function ($){
            $.fn.filemanager = function(type) {
                type = type || 'file';

                this.on('click', function(e) {
                    let target_input = $('#' + $(this).data('input'));
                    window.open('/admin/lfm?type=' + type, 'FileManager', 'width=900,height=600');
                    window.SetUrl = function (items) {
                        let file_path = items.map(function (item) {
                            return item.url;
                        }).join(',');

                        // set the value of the desired input to image url
                        target_input.val('').val(file_path).trigger('change');

                    };
                    return false;
                });
            }
        })(jQuery);
        $(document).ready(function () {
            let options = {
                height: '230px',
                toolbar: [
                    {name: 'document', items: ['Source', '-']},
                    {
                        name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                            '-',
                            'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                    },
                    {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-']},
                    {name: 'styles', items: ['Format']},
                    {name: 'colors', items: ['TextColor']},
                    {name: 'insert', items: ['Image']},
                ],
                contentsCss: ["{{url('/public/plugins/bootstrap-5/css/bootstrap.min.css')}}","{{url('/public/css/web.css?t=' . time())}}"],
                filebrowserImageBrowseUrl: '/admin/lfm?type=Images',
                filebrowserImageUploadUrl: '/admin/lfm/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/admin/lfm?type=Files',
                filebrowserUploadUrl: '/admin/lfm/upload?type=Files&_token='
            };
            CKEDITOR.replace('content', options);
            $('#lfm').filemanager('image');
        });
    </script>
@endpush
