<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Gallery;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_gallery');
    }

    public function view(AuthUser $authUser, Gallery $gallery): bool
    {
        return $authUser->can('view_gallery');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_gallery');
    }

    public function update(AuthUser $authUser, Gallery $gallery): bool
    {
        return $authUser->can('update_gallery');
    }

    public function delete(AuthUser $authUser, Gallery $gallery): bool
    {
        return $authUser->can('delete_gallery');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_gallery');
    }

    public function restore(AuthUser $authUser, Gallery $gallery): bool
    {
        return $authUser->can('restore_gallery');
    }

    public function forceDelete(AuthUser $authUser, Gallery $gallery): bool
    {
        return $authUser->can('force_delete_gallery');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_gallery');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_gallery');
    }

    public function replicate(AuthUser $authUser, Gallery $gallery): bool
    {
        return $authUser->can('replicate_gallery');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_gallery');
    }

}