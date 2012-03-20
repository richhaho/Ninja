<?php

namespace Modules\Voip\;

use App\Providers\AuthServiceProvider;

class VoipAuthProvider extends AuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \Modules\Voip\Models\Voip::class => \Modules\Voip\Policies\VoipPolicy::class,
    ];
}
