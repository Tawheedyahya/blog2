@extends('layouts.app')
@section('content')
 @include('components.toast')
    {{-- @if ($errors->any())
<p>{{$errors->first()}}</p>
@endif --}}
    <div class="container mt-4">
        <h2>Add a New Post</h2>
        <form action="{{ url('/post') }}" method="POST" enctype="multipart/form-data" id='insert_form'>
            @csrf
            {{-- @if (isset($post_id))
                @method('PUT')
            @endif --}}
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" name="title" id="title"
                    value="{{ old('title', isset($post_id) ? $post_id->title : '') }}" class="form-control"
                    placeholder="Enter post title">

                <div class="title_error error"></div>
                @if (isset($post_id))
                    <input type="hidden" name="id" id="" value="{{ $post_id->id }}">
                @endif
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Post Content</label>
                <textarea name="contents" id="contents" class="form-control" rows="4" placeholder=" command you post">
@if (isset($post_id))
{!! old('contents', $post_id->contents) !!}
@endif {{ old('contents') }}
</textarea>
                <div class="contents_error error"></div>
                @error('contents')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="postImg" class="form-label">Post Image</label>
                <input type="file" name="postImg" id="postImg">
                <div class="postImg_error error"></div>
                @error('postImg')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            @if (isset($post_id))
                <img src="{{ asset('images/' . $post_id->postImg) }}" alt="" height="300" width="300"
                    id='preview'><br><br>
            @endif
            <button type="submit" class="btn btn-primary">
                @if (isset($post_id))
                    update
                @else
                    submit
                @endif
            </button>
        </form>
    </div>





    <script>
        let contents = document.querySelector('#contents')
        ClassicEditor.create(contents, {
            toolbar: ['italic', 'bold']
        })


        $(document).ready(function() {
            $('#postImg').on('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    $('#preview').attr('src', URL.createObjectURL(file))
                }
            })
        })
        $(document).ready(function() {
            let form = $("#insert_form");
            form.submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                // console.log(formData)
                const url = $(this).attr('action');
                const method = $(this).attr('method');
                // console.log(url);
                fetch(url, {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    },
                    body: formData
                }).then(async response => {
                    let res = await response.json();

                    if (res.status) {
                        setTimeout(() => {
                            window.location.assign(res.redirection)
                        }, 2500);
                        toast(res.message);
                    } else {
                        let errors = res.errors;
                        console.log(errors);
                        display_errors(errors);
                    }


                })
            })
        })


        function display_errors(errors, fun) {
            $(".error").text("");
            if (errors) {
                $.map(errors, function(val, key) {
                    $("." + key + "_error").text(val);
                });

            }
            // fun();
        }
    </script>
@endsection
