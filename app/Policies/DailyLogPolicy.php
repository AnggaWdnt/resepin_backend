<?php

namespace App\Policies;

use App\Models\DailyLog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DailyLogPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DailyLog $dailyLog): bool
    {
        return $user->id === $dailyLog->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DailyLog $dailyLog): bool
    {
        return $user->id === $dailyLog->user_id;
    }
}