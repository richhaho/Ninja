<?php

namespace Modules\Voip\Http\Requests;

use App\Http\Requests\EntityRequest;

class VoipRequest extends EntityRequest
{
    protected $entityType = 'voip';
}
