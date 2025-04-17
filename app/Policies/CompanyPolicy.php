<?php

namespace App\Policies;

use App\Models\User;

class CompanyPolicy
{
    public function update(User $user, $company): bool
    {
        return $user->company_id === $company->id;
    }
}
