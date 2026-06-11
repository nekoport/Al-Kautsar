<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MosqueProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class MosqueProfilePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_mosque_profile');
    }

    public function view(AuthUser $authUser, MosqueProfile $mosqueProfile): bool
    {
        return $authUser->can('view_mosque_profile');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_mosque_profile');
    }

    public function update(AuthUser $authUser, MosqueProfile $mosqueProfile): bool
    {
        return $authUser->can('update_mosque_profile');
    }

    public function delete(AuthUser $authUser, MosqueProfile $mosqueProfile): bool
    {
        return $authUser->can('delete_mosque_profile');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_mosque_profile');
    }

    public function restore(AuthUser $authUser, MosqueProfile $mosqueProfile): bool
    {
        return $authUser->can('restore_mosque_profile');
    }

    public function forceDelete(AuthUser $authUser, MosqueProfile $mosqueProfile): bool
    {
        return $authUser->can('force_delete_mosque_profile');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_mosque_profile');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_mosque_profile');
    }

    public function replicate(AuthUser $authUser, MosqueProfile $mosqueProfile): bool
    {
        return $authUser->can('replicate_mosque_profile');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_mosque_profile');
    }

}