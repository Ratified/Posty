<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(2); //Laravel Collection
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request){
         $postData = $request->validate([
            'body' => 'required'
         ]);

         $postData['user_id'] = auth()->id();

         //Post::create($postData);

         $request->user()->posts()->create($postData);

         return back();
    }
}
