<?php

namespace App\Policies;

use App\Models\User;

class ItemPolicy
{
    public function update(User $user, $item): bool
    {
        return $user->company_id === $item->company_id;
    }
}
