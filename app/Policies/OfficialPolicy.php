<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Official;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfficialPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_official');
    }

    public function view(AuthUser $authUser, Official $official): bool
    {
        return $authUser->can('view_official');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_official');
    }

    public function update(AuthUser $authUser, Official $official): bool
    {
        return $authUser->can('update_official');
    }

    public function delete(AuthUser $authUser, Official $official): bool
    {
        return $authUser->can('delete_official');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_official');
    }

    public function restore(AuthUser $authUser, Official $official): bool
    {
        return $authUser->can('restore_official');
    }

    public function forceDelete(AuthUser $authUser, Official $official): bool
    {
        return $authUser->can('force_delete_official');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_official');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_official');
    }

    public function replicate(AuthUser $authUser, Official $official): bool
    {
        return $authUser->can('replicate_official');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_official');
    }

}