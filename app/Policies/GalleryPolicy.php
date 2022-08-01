<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gallery;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryPolicy
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

    public function update(User $user, Gallery $gallery)
    {
        return $user->id === $gallery->user_id;
    }

    public function delete(User $user, Gallery $gallery)
    {
        return $user->id === $gallery->user_id;
    }
}
