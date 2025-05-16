<?php

namespace App\Policies;

use App\Models\User;

class ServicePolicy
{
    public function update(User $user, $service)
    {
        return $user->company_id === $service->user->company_id;
    }

    public function delete(User $user, $service)
    {
        return $user->company_id === $service->user->company_id;
    }
    public function viewPrice(User $user, $service)
    {
        return $user->company_id === $service->user->company_id;
    }

    public function download(User $user, $service)
    {
        return $user->company_id === $service->user->company_id;
    }
}
