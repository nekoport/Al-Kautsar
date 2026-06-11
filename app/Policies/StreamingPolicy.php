<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Streaming;
use Illuminate\Auth\Access\HandlesAuthorization;

class StreamingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_streaming');
    }

    public function view(AuthUser $authUser, Streaming $streaming): bool
    {
        return $authUser->can('view_streaming');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_streaming');
    }

    public function update(AuthUser $authUser, Streaming $streaming): bool
    {
        return $authUser->can('update_streaming');
    }

    public function delete(AuthUser $authUser, Streaming $streaming): bool
    {
        return $authUser->can('delete_streaming');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_streaming');
    }

    public function restore(AuthUser $authUser, Streaming $streaming): bool
    {
        return $authUser->can('restore_streaming');
    }

    public function forceDelete(AuthUser $authUser, Streaming $streaming): bool
    {
        return $authUser->can('force_delete_streaming');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_streaming');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_streaming');
    }

    public function replicate(AuthUser $authUser, Streaming $streaming): bool
    {
        return $authUser->can('replicate_streaming');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_streaming');
    }

}