<?php

namespace Modules\Voip\Transformers;

use Modules\Voip\Models\Voip;
use App\Ninja\Transformers\EntityTransformer;

/**
 * @SWG\Definition(definition="Voip", @SWG\Xml(name="Voip"))
 */

class VoipTransformer extends EntityTransformer
{
    /**
    * @SWG\Property(property="id", type="integer", example=1, readOnly=true)
    * @SWG\Property(property="user_id", type="integer", example=1)
    * @SWG\Property(property="account_key", type="string", example="123456")
    * @SWG\Property(property="updated_at", type="integer", example=1451160233, readOnly=true)
    * @SWG\Property(property="archived_at", type="integer", example=1451160233, readOnly=true)
    */

    /**
     * @param Voip $voip
     * @return array
     */
    public function transform(Voip $voip)
    {
        return array_merge($this->getDefaults($voip), [
            'name' => $voip->name,
            'description' => $voip->description,
            'id' => (int) $voip->public_id,
            'updated_at' => $this->getTimestamp($voip->updated_at),
            'archived_at' => $this->getTimestamp($voip->deleted_at),
        ]);
    }
}
