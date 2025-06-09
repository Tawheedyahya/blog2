<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
<div class="card col-12 col-md-6 col-lg-3 mb-5">
    <div class="card-header">
        <h3 class="card-title text-center">{{ $title }}</h3>
    </div>
    <div class="card-body img-center">
        @if (strlen($src)>2)
        <img src="{{ asset('images/' . $src) }}" alt="" class="img-fluid">
        @else
        <p class="d-flex">no images posted</p>
        @endif
    </div>
    <div class="card-footer">
        <h3>{!! $footer ?? 'no info' !!}</h3>
    </div>
    <div class="card-footer">
        <nav>
            <ul class="nav">
                <li class="nav-items">
                    <a href="#" class="nav-link">
                        <i class="bi bi-hand-thumbs-up"></i> like
                    </a>
                </li>
                <li class="nav-items"> <a href="/edit_post/{{$id}}" class="nav-link">
                        <i class="bi bi-pencil"></i> edit
                    </a></li>
                <li class="nav-items"> <a href="/delete_post/{{$id}} " class="nav-link text-danger" onclick="delete_alert()">
                        <i class="bi bi-trash"></i> delete
                    </a></li>
            </ul>
        </nav>
    </div>
</div>
<style>
    .nav {
        display: flex;
        justify-content: space-between;
    }
</style>
