<?php

namespace Modules\Voip\Http\Controllers;

use Auth;
use App\Http\Controllers\BaseController;
use App\Services\DatatableService;
use Modules\Voip\Datatables\VoipDatatable;
use Modules\Voip\Repositories\VoipRepository;
use Modules\Voip\Http\Requests\VoipRequest;
use Modules\Voip\Http\Requests\CreateVoipRequest;
use Modules\Voip\Http\Requests\UpdateVoipRequest;

class VoipController extends BaseController
{
    protected $VoipRepo;
    //protected $entityType = 'voip';

    public function __construct(VoipRepository $voipRepo)
    {
        //parent::__construct();

        $this->voipRepo = $voipRepo;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('list_wrapper', [
            'entityType' => 'voip',
            'datatable' => new VoipDatatable(),
            'title' => mtrans('voip', 'voip_list'),
        ]);
    }

    public function datatable(DatatableService $datatableService)
    {
        $search = request()->input('sSearch');
        $userId = Auth::user()->filterId();

        $datatable = new VoipDatatable();
        $query = $this->voipRepo->find($search, $userId);

        return $datatableService->createDatatable($datatable, $query);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(VoipRequest $request)
    {
        $data = [
            'voip' => null,
            'method' => 'POST',
            'url' => 'voip',
            'title' => mtrans('voip', 'new_voip'),
        ];

        return view('voip::edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateVoipRequest $request)
    {
        $voip = $this->voipRepo->save($request->input());

        return redirect()->to($voip->present()->editUrl)
            ->with('message', mtrans('voip', 'created_voip'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(VoipRequest $request)
    {
        $voip = $request->entity();

        $data = [
            'voip' => $voip,
            'method' => 'PUT',
            'url' => 'voip/' . $voip->public_id,
            'title' => mtrans('voip', 'edit_voip'),
        ];

        return view('voip::edit', $data);
    }

    /**
     * Show the form for editing a resource.
     * @return Response
     */
    public function show(VoipRequest $request)
    {
        return redirect()->to("voip/{$request->voip}/edit");
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateVoipRequest $request)
    {
        $voip = $this->voipRepo->save($request->input(), $request->entity());

        return redirect()->to($voip->present()->editUrl)
            ->with('message', mtrans('voip', 'updated_voip'));
    }

    /**
     * Update multiple resources
     */
    public function bulk()
    {
        $action = request()->input('action');
        $ids = request()->input('public_id') ?: request()->input('ids');
        $count = $this->voipRepo->bulk($ids, $action);

        return redirect()->to('voip')
            ->with('message', mtrans('voip', $action . '_voip_complete'));
    }
}
