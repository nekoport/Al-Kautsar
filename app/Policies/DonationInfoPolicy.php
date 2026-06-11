<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DonationInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class DonationInfoPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_donation_info');
    }

    public function view(AuthUser $authUser, DonationInfo $donationInfo): bool
    {
        return $authUser->can('view_donation_info');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_donation_info');
    }

    public function update(AuthUser $authUser, DonationInfo $donationInfo): bool
    {
        return $authUser->can('update_donation_info');
    }

    public function delete(AuthUser $authUser, DonationInfo $donationInfo): bool
    {
        return $authUser->can('delete_donation_info');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_donation_info');
    }

    public function restore(AuthUser $authUser, DonationInfo $donationInfo): bool
    {
        return $authUser->can('restore_donation_info');
    }

    public function forceDelete(AuthUser $authUser, DonationInfo $donationInfo): bool
    {
        return $authUser->can('force_delete_donation_info');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_donation_info');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_donation_info');
    }

    public function replicate(AuthUser $authUser, DonationInfo $donationInfo): bool
    {
        return $authUser->can('replicate_donation_info');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_donation_info');
    }

}