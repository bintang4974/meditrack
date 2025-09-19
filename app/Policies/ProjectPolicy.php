<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Hanya owner yang boleh lihat join requests
     */
    public function viewJoinRequests(User $user, Project $project)
    {
        return $project->owner_id === $user->id
            || $user->projects()
            ->wherePivot('role_in_project', 'owner')
            ->where('project_id', $project->id)
            ->exists();
    }

    /**
     * Approve/Reject join request
     */
    public function manageJoinRequests(User $user, Project $project)
    {
        return $project->owner_id === $user->id
            || $user->projects()
            ->wherePivot('role_in_project', 'owner')
            ->where('project_id', $project->id)
            ->exists();
    }
}
