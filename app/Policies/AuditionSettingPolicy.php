<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AuditionSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuditionSettingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AuditionSetting');
    }

    public function view(AuthUser $authUser, AuditionSetting $auditionSetting): bool
    {
        return $authUser->can('View:AuditionSetting');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AuditionSetting');
    }

    public function update(AuthUser $authUser, AuditionSetting $auditionSetting): bool
    {
        return $authUser->can('Update:AuditionSetting');
    }

    public function delete(AuthUser $authUser, AuditionSetting $auditionSetting): bool
    {
        return $authUser->can('Delete:AuditionSetting');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:AuditionSetting');
    }

    public function restore(AuthUser $authUser, AuditionSetting $auditionSetting): bool
    {
        return $authUser->can('Restore:AuditionSetting');
    }

    public function forceDelete(AuthUser $authUser, AuditionSetting $auditionSetting): bool
    {
        return $authUser->can('ForceDelete:AuditionSetting');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AuditionSetting');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AuditionSetting');
    }

    public function replicate(AuthUser $authUser, AuditionSetting $auditionSetting): bool
    {
        return $authUser->can('Replicate:AuditionSetting');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AuditionSetting');
    }

}