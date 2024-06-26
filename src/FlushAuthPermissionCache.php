<?php

namespace Alterindonesia\KeycloakGuard;

use Illuminate\Support\Facades\Auth;

class FlushAuthPermissionsCache
{
    public function handle($event): void
    {
        Auth::logout();
    }
}
