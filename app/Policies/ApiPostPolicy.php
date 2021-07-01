<?php

namespace App\Policies;

use App\ApiUser;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApiPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param App\ApiUser $user
     * @return mixed
     */
    public function viewAny(ApiUser $user)
    {
        //
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param App\ApiUser $user
     * @param App\Post $post
     * @return mixed
     */
    public function view(ApiUser $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param App\ApiUser $user
     * @return mixed
     */
    public function create(ApiUser $user)
    {
        //
        return $user->hasAccess(["post.create"]);
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param App\ApiUser $user
     * @param App\Post $post
     * @return mixed
     */
    public function update(ApiUser $user, Post $post)
    {
        //
        return $user->hasAccess(["post.update"]);

    }

    public function publish(ApiUser $user)
    {
        return $user->hasAccess(['post.publish']);
    }

    public function draft(ApiUser $user)
    {
        return $user->inRole('editor');
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param App\User $user
     * @param App\Post $post
     * @return mixed
     */
    public function delete(ApiUser $user, Post $post)
    {
        //
    }
}
