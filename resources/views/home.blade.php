@extends('layouts.app')
@section('content')
@if(session('danger'))
<!-- Toast container -->
@include('components.toast',[
    'msg'=>'delete successfully',
])
@endif

@if(session('success'))
<div class="alert alert-success" id="flash-message">{{ session('success') }}</div>
@endif
<div class="text-end mb-3">
<a href="{{route('insert')}}" class="btn btn-primary">+ ADD POSTS</a>
</div>
{{-- <div class="m-5"></div> --}}
<div class="row">
@foreach ($posts as $posts )
@include('components.card',[
    'title'=>$posts->title,
    'footer'=>$posts->contents,
    'src'=>$posts->postImg,
    'id'=>$posts->id
])

@endforeach
</div>

@endsection



