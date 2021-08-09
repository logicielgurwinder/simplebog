<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface; 
class PostController extends Controller
{

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository=$postRepository;
    }

    public function createNewPost(PostRequest $request)
    {
        $post=Post::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'user_id'=>auth()->id()
        ]);
        return response([
            'post'=>$post
        ],200);
    }

    public function updatePost(PostRequest $request)
    {
        $post=$this->postRepository->find($request->id);
        if (!is_null($post)) {
            $post->update([
                'title'=>$request->title,
                'body'=>$request->body,
                'user_id'=>auth()->id()
            ]);
            return response([
                'post'=>$post
            ],200);
        }
        return response([
            'message'=>'post not found'
        ],404);
    }

    public function deletePost(Request $request)
    {
        $post=$this->postRepository->find($request->id);
        if (!is_null($post)) {
            $post->delete();
            return response([
                'message'=>'post deleted successfully'
            ],200);
        }
        return response([
            'message'=>'post not found'
        ],404);
    }

    public function getAllPosts()
    {
        return response([
            'posts'=>$this->postRepository->getAll()
        ],200);
    }

    public function searchPosts(Request $request)
    {
        $search=$request->search;
        $posts=Post::where('title','LIKE',"%$search%")
                    ->orWhere('body','LIKE',"%$search%")
                    ->get();
        return response([
            'posts'=>$posts
        ],200);            
    }
}
