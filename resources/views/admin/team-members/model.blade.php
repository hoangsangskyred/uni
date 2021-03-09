<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control text-capitalize" id="full_name" name="full_name" placeholder="Tên hiển thị" value="{{old('full_name', $needle->full_name)}}" required
                           autofocus>
                    <label for="full_name">Tên hiển thị</label>
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control text-capitalize" id="title" name="title" placeholder="Nghề nghiệp / Chức vụ" value="{{old('title', $needle->title)}}" required>
                    <label for="title">Nghề nghiệp / Chức vụ</label>
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <div class="input-group">
                <button type="button" id="lfm" data-input="avatarPath" class="btn btn-outline-secondary">
                    <i class="fas fa-photo"></i> Chọn avatar
                </button>
                <input id="avatarPath" class="form-control" type="text" name="avatarPath" value="{{old('avatarPath', $needle->avatar_path)}}" placeholder="Chọn hình đại diện cho dự án">
            </div>
            <small class="text-muted"><i class="fas fa-exclamation-circle"></i> Hiển thị đẹp nhất với kích thước 270 x 320 px</small>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Link facebook" value="{{old('facebook', $needle->facebook)}}">
            <label for="facebook">Link Facebook</label>
            <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Link Twitter" value="{{old('twitter', $needle->twitter)}}">
            <label for="twitter">Link Twitter</label>
            <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="linkedId" name="linkedId" placeholder="Link LinkedIn" value="{{old('linkedId', $needle->linkedid)}}">
            <label for="linkedId">Link LinkedIn</label>
            <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
        </div>

        <div class="form-floating mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="show" id="showCheck" {{old('show', $needle->show)=='Y'?'checked':''}}>
                <label class="form-check-label" for="showCheck">
                    Hiển thị
                </label>
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
