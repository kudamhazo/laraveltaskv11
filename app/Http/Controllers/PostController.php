<?php

namespace App\Http\Controllers;

use App\Constants\Size;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Website $website)
    {

        $rules = [
            'title' => ['required', 'max:' . Size::POST_TITLE],
            'description' => ['required', 'max:' . Size::POST_DESCRIPTION],
        ];

        $messages = [
            'size' => 'The :attribute must be of size :size or less.',
            'required' => 'The :attribute field is required.',
        ];

        $this->validate(
            $request,
            $rules,
            $messages
        );

        $post = new Post($request->only(['title', 'description']));
        $website->posts()->save($post);
        return response($post, 201);
    }

}
