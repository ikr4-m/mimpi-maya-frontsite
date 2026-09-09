<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\AuditionArchive;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class AuditionArchivePolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AuditionArchive');
    }

    public function view(AuthUser $authUser, AuditionArchive $auditionArchive): bool
    {
        return $authUser->can('View:AuditionArchive');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AuditionArchive');
    }

    public function update(AuthUser $authUser, AuditionArchive $auditionArchive): bool
    {
        return $authUser->can('Update:AuditionArchive');
    }

    public function delete(AuthUser $authUser, AuditionArchive $auditionArchive): bool
    {
        return $authUser->can('Delete:AuditionArchive');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:AuditionArchive');
    }

    public function restore(AuthUser $authUser, AuditionArchive $auditionArchive): bool
    {
        return $authUser->can('Restore:AuditionArchive');
    }

    public function forceDelete(AuthUser $authUser, AuditionArchive $auditionArchive): bool
    {
        return $authUser->can('ForceDelete:AuditionArchive');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AuditionArchive');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AuditionArchive');
    }

    public function replicate(AuthUser $authUser, AuditionArchive $auditionArchive): bool
    {
        return $authUser->can('Replicate:AuditionArchive');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AuditionArchive');
    }
}
