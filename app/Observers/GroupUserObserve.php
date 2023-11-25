<?php

namespace App\Observers;

use App\Models\GroupUser;
use App\Models\Group;
use Carbon\Carbon;


class GroupUserObserve
{
    /**
     * Handle the GroupUser "created" event.
     */
    public function saving(GroupUser $groupUser): void
    {
        $group = new Group();
        $expiresTime = $group::find($groupUser->group_id)->first();
        $currentTime = Carbon::now();
        $groupUser->expires_at = $currentTime->addHours($expiresTime->expire_hours);
    }
}
