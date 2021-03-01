<div class="modal fade " id="crawlModal" tabindex="-1" aria-labelledby="crawlModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route($controller->name . '.crawl')}}" class="needs-validation" method="post" novalidate>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="crawlModalLabel">Lấy tin từ website khác</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="category" name="category">
                            <option value="0">- chọn -</option>
                            @foreach(\App\Models\ArticleCategory::orderBy('display_name')->get() as $articleCategory)
                                <option value="{{$articleCategory->id}}" {{old('category', $needle->article_category_id)==$articleCategory->id?'selected':''}}>{{$articleCategory->display_name}}</option>
                            @endforeach
                        </select>
                        <label for="category">Chủ đề</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" name="sourceLink" id="sourceLink" placeholder="Nhập đường dẫn website" class="form-control" required/>
                        <label for="sourceLink">URL <small class="text-muted">https://domain.com/...</small></label>
                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> Không được rỗng</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Bắt đầu</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dừng</button>
                </div>
            </form>
        </div>
    </div>
</div>
