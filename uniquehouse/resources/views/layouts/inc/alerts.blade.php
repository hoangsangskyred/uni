@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <ul class="nav flex-column">
    @foreach($errors->all() as $error)
        <li><i class="fas fa-exclamation-circle"></i> {{$error}}</li>
        @endforeach
    </ul>
</div>
    @endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
