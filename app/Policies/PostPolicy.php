<?php

namespace App\Policies;

use App\Model\Controller\User;
use App\Model\Blog\Post;
use Illuminate\Auth\Access\HandlesAuthorization;


class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function updatePost(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
    
    
}
