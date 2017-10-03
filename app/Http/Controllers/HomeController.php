<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Blog\Post;
use App\Model\Controller\User;
use Illuminate\Support\Facades\Gate;
Use Illuminate\Foundation\Support\Providers\AuthServiceProvider;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $posts = $post->all();//select all post in database
        //$posts = $post->where('user_id', auth()->user()->id)->get();//select post only the user auth
        return view('home', compact('posts'));
    }
    
    public function update($id)
    {
        $post = Post::find($id);
        
        
        if (Gate::allows('update-post', $post)) {
                // The current user can update the post...
            return view('post-update', compact('post'));
        }

        if (Gate::denies('update-post', $post)) {
                // The current user can't update the post...
                abort(403, 'Unauthorized Willian');
        }
        
    }
    
    public function rolesPermission()
    {
         
        echo '<pre>'.auth()->user()->name.'<pre>';
        foreach (auth()->user()->roles as $role){
            echo '<pre>'.$role->name.'->';
            $permissions = $role->permissions;
            foreach ($permissions as $permission){
                echo $permission->name.',';
            }
            echo '</pre>';
        }
    }
}
