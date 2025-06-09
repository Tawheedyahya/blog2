<?php

namespace App\Http\Controllers;

use App\Models\Blogpost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class postController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show insert/update form
    public function post()
    {
        return view('post.insert_update_form');
    }

    // Show form for edit
    public function update_post($id)
    {
        $post_id = Blogpost::findOrFail($id);
        return view('post.insert_update_form', compact('post_id'));
    }

    // Insert or Update Post
    public function insert_post(Request $request)
    {
        $isUpdate = $request->has('id'); // Check if updating

        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'contents' => ['required', 'string', 'max:255'],
        ];

        // Only require image if creating
        if (!$isUpdate) {
            $rules['postImg'] = ['required', 'file', 'mimes:jpg,png'];
        } else {
            $rules['postImg'] = ['nullable', 'file', 'mimes:jpg,png'];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $msgBag = $validator->errors()->toArray();
            $errs = [];
            foreach ($msgBag as $key => $value) {
                $errs[$key] = $value[0];
            }

            return response()->json([
                'status' => false,
                'message' => 'validation failed',
                'errors' => $errs

            ]);
        }

        // If ID is present, update the post
        if ($isUpdate) {
            return $this->update_post_data($request);
        }

        // Create new post
        $post = new Blogpost();
        $post->title = $request->input('title');
        $post->contents = $request->input('contents');
        $post->user_id = Auth::id();

        if ($request->hasFile('postImg')) {
            $file = $request->file('postImg');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $post->postImg = $fileName;
        }

        $post->save();

        return response()->json([
            'status' => true,
            'message' => 'successfully posted',
            'redirection'=>'/'
        ]);
    }

    // Update post data
    public function update_post_data($request)
    {
        $post = Blogpost::findOrFail($request->id);
        $this->authorize('update', $post);

        $post->title = $request->title;
        $post->contents = $request->contents;

        if ($request->hasFile('postImg')) {
            $filepath = public_path('images/' . $post->postImg);
            if (file_exists($filepath)) {
                @unlink($filepath);
            }

            $file = $request->file('postImg');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $post->postImg = $fileName;
        }

        $post->save();

        return response()->json([
            'status' => true,
            'message' => 'successfully updated',
            'redirection'=>'/'
        ]);
    }

    // Delete post
    public function delete_post($id)
    {
        $post = Blogpost::findOrFail($id);
        $this->authorize('delete', $post);

        $imagePath = public_path('images/' . $post->postImg);
        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }

        $post->delete();

        return redirect()->route('home')->with('danger', 'postDeleted');
    }
}

