<?php

namespace App\Policies;

use App\Facades\Identity;
use App\Traits\AdminPolicyTrait;
use App\User;
use App\Models\CampaignUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignUserPolicy
{
    use HandlesAuthorization;
    use AdminPolicyTrait;
    
    /**
     * Determine whether the user can view the campaignUser.
     *
     * @param  \App\User  $user
     * @param  \App\Models\CampaignUser  $campaignUser
     * @return mixed
     */
    public function view(User $user, CampaignUser $campaignUser)
    {
    }

    /**
     * Determine whether the user can create campaignUsers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the campaignUser.
     *
     * @param  \App\User  $user
     * @param  \App\Models\CampaignUser  $campaignUser
     * @return mixed
     */
    public function update(User $user, CampaignUser $campaignUser)
    {
        return $user->campaign->id == $campaignUser->campaign->id
            && $this->isAdmin($user) && $campaignUser->role != 'owner';
    }

    /**
     * Determine whether the user can delete the campaignUser.
     *
     * @param  \App\User  $user
     * @param  \App\Models\CampaignUser  $campaignUser
     * @return mixed
     */
    public function delete(User $user, CampaignUser $campaignUser)
    {
        return $user->campaign->id == $campaignUser->campaign->id
            && $this->isAdmin($user) && $campaignUser->role != 'owner';
    }

    /**
     * Determine whether the current user can switch to the user.
     *
     * @param  \App\User  $user
     * @param  \App\Models\CampaignUser  $campaignUser
     * @return mixed
     */
    public function switch(User $user, CampaignUser $campaignUser)
    {
        return $user->campaign->id == $campaignUser->campaign->id
            && $this->isAdmin($user) && $campaignUser->role != 'owner' &&
            // Don't allow impersonating if we are already impersonating
            !Identity::isImpersonating();
    }
}
