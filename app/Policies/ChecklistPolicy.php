<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Checklist;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChecklistPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Checklist $checklist): bool
    {
        return $user->id === $checklist->user_id;
    }

    public function destroy(User $user, Checklist $checklist): bool
    {
        return $user->id === $checklist->user_id;
    }
}
