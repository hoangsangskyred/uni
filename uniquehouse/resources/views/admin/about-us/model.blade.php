<div class="row">
    <div class="col-md-12 mx-auto">
        @include('layouts.inc.alerts')

        <div class="form-floating mb-3">
            <input type="text" class="form-control text-capitalize" id="title" name="title" placeholder="Tiêu đề" value="{{old('title', $needle->title)}}" required
                   autofocus>
            <label for="title">Tiêu đề <small class="text-muted">(Không quá 170 chữ)</small></label>
            <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
        </div>
        <div class="form-group">
            <label>Nội dung chi tiết</label>
            <textarea id="content" name="content" class="form-control" required>{{old('content', $needle->content)}}</textarea>
            <div class="invalid-feedback">
                <i class="fas fa-exclamation-circle"></i> Không được rỗng
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
                height: '280px',
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
