<?php

namespace App\Policies;

use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttachmentPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Media $media): bool
    {
        return $user->id === $media->getCustomProperty('user_id');
    }

    public function destroy(User $user, Media $media): bool
    {
        return $user->id === $media->getCustomProperty('user_id');
    }
}
