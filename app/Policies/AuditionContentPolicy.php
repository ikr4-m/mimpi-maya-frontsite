<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AuditionContent;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuditionContentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AuditionContent');
    }

    public function view(AuthUser $authUser, AuditionContent $auditionContent): bool
    {
        return $authUser->can('View:AuditionContent');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AuditionContent');
    }

    public function update(AuthUser $authUser, AuditionContent $auditionContent): bool
    {
        return $authUser->can('Update:AuditionContent');
    }

    public function delete(AuthUser $authUser, AuditionContent $auditionContent): bool
    {
        return $authUser->can('Delete:AuditionContent');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:AuditionContent');
    }

    public function restore(AuthUser $authUser, AuditionContent $auditionContent): bool
    {
        return $authUser->can('Restore:AuditionContent');
    }

    public function forceDelete(AuthUser $authUser, AuditionContent $auditionContent): bool
    {
        return $authUser->can('ForceDelete:AuditionContent');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AuditionContent');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AuditionContent');
    }

    public function replicate(AuthUser $authUser, AuditionContent $auditionContent): bool
    {
        return $authUser->can('Replicate:AuditionContent');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AuditionContent');
    }

}