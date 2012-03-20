<?php

namespace Modules\Voip\Models;

use App\Models\EntityModel;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voip extends EntityModel
{
    use PresentableTrait;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $presenter = 'Modules\Voip\Presenters\VoipPresenter';

    /**
     * @var string
     */
    protected $fillable = ["name","description"];

    /**
     * @var string
     */
    protected $table = 'voip';

    public function getEntityType()
    {
        return 'voip';
    }

}
