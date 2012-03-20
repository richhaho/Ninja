<?php

namespace Modules\Voip\Repositories;

use DB;
use Modules\Voip\Models\Voip;
use App\Ninja\Repositories\BaseRepository;
//use App\Events\VoipWasCreated;
//use App\Events\VoipWasUpdated;

class VoipRepository extends BaseRepository
{
    public function getClassName()
    {
        return 'Modules\Voip\Models\Voip';
    }

    public function all()
    {
        return Voip::scope()
                ->orderBy('created_at', 'desc')
                ->withTrashed();
    }

    public function find($filter = null, $userId = false)
    {
        $query = DB::table('voip')
                    ->where('voip.account_id', '=', \Auth::user()->account_id)
                    ->select(
                        'voip.name', 'voip.description', 
                        'voip.public_id',
                        'voip.deleted_at',
                        'voip.created_at',
                        'voip.is_deleted',
                        'voip.user_id'
                    );

        $this->applyFilters($query, 'voip');

        if ($userId) {
            $query->where('clients.user_id', '=', $userId);
        }

        /*
        if ($filter) {
            $query->where();
        }
        */

        return $query;
    }

    public function save($data, $voip = null)
    {
        $entity = $voip ?: Voip::createNew();

        $entity->fill($data);
        $entity->save();

        /*
        if (!$publicId || intval($publicId) < 0) {
            event(new ClientWasCreated($client));
        } else {
            event(new ClientWasUpdated($client));
        }
        */

        return $entity;
    }

}
