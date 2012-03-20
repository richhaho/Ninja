<?php

namespace Modules\Voip\Datatables;

use Utils;
use URL;
use Auth;
use App\Ninja\Datatables\EntityDatatable;

class VoipDatatable extends EntityDatatable
{
    public $entityType = 'voip';
    public $sortCol = 1;

    public function columns()
    {
        return [
            [
                'name',
                function ($model) {
                    return $model->name;
                }
            ],[
                'description',
                function ($model) {
                    return $model->description;
                }
            ],
            [
                'created_at',
                function ($model) {
                    return Utils::fromSqlDateTime($model->created_at);
                }
            ],
        ];
    }

    public function actions()
    {
        return [
            [
                mtrans('voip', 'edit_voip'),
                function ($model) {
                    return URL::to("voip/{$model->public_id}/edit");
                },
                function ($model) {
                    return Auth::user()->can('editByOwner', ['voip', $model->user_id]);
                }
            ],
        ];
    }

}
