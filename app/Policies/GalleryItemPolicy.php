<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\GalleryItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryItemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_gallery_item');
    }

    public function view(AuthUser $authUser, GalleryItem $galleryItem): bool
    {
        return $authUser->can('view_gallery_item');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_gallery_item');
    }

    public function update(AuthUser $authUser, GalleryItem $galleryItem): bool
    {
        return $authUser->can('update_gallery_item');
    }

    public function delete(AuthUser $authUser, GalleryItem $galleryItem): bool
    {
        return $authUser->can('delete_gallery_item');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_gallery_item');
    }

    public function restore(AuthUser $authUser, GalleryItem $galleryItem): bool
    {
        return $authUser->can('restore_gallery_item');
    }

    public function forceDelete(AuthUser $authUser, GalleryItem $galleryItem): bool
    {
        return $authUser->can('force_delete_gallery_item');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_gallery_item');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_gallery_item');
    }

    public function replicate(AuthUser $authUser, GalleryItem $galleryItem): bool
    {
        return $authUser->can('replicate_gallery_item');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_gallery_item');
    }

}