<?php

namespace App\Policies;

use App\Models\Consultation;
use App\Models\User;

class ConsultationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user, Consultation $consultation)
    {
        // Check if the user owns the consultation
        return $user->id === $consultation->user_id;
    }

    public function cancel(User $user, Consultation $consultation)
    {
        // Example: Check if the user owns the consultation or has a role that allows cancellation
        return $user->id === $consultation->user_id; 
        // return $user->id === $consultation->user_id || $user->isAdmin(); 
    }
}
