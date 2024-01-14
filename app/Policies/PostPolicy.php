<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function create(User $user): bool
    {
        return true;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Post $post): bool
    {
        if ($post->published_at) {
            return true;
        }

        return $user && $user->is($post->author);
    }

    public function viewAuthor(?User $user, Post $post): bool
    {
        return $this->view($user, $post);
    }

    public function viewComments(?User $user, Post $post): bool
    {
        return $this->view($user, $post);
    }

    public function viewTags(?User $user, Post $post): bool
    {
        return $this->view($user, $post);
    }

    public function viewCategories(?User $user, Post $post): bool
    {
        return $this->view($user, $post);
    }
}
