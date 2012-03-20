<?php

namespace Modules\Voip\Http\ApiControllers;

use App\Http\Controllers\BaseAPIController;
use Modules\Voip\Repositories\VoipRepository;
use Modules\Voip\Http\Requests\VoipRequest;
use Modules\Voip\Http\Requests\CreateVoipRequest;
use Modules\Voip\Http\Requests\UpdateVoipRequest;

class VoipApiController extends BaseAPIController
{
    protected $VoipRepo;
    protected $entityType = 'voip';

    public function __construct(VoipRepository $voipRepo)
    {
        parent::__construct();

        $this->voipRepo = $voipRepo;
    }

    /**
     * @SWG\Get(
     *   path="/voip",
     *   summary="List voip",
     *   operationId="listVoips",
     *   tags={"voip"},
     *   @SWG\Response(
     *     response=200,
     *     description="A list of voip",
     *      @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/Voip"))
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function index()
    {
        $data = $this->voipRepo->all();

        return $this->listResponse($data);
    }

    /**
     * @SWG\Get(
     *   path="/voip/{voip_id}",
     *   summary="Individual Voip",
     *   operationId="getVoip",
     *   tags={"voip"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="voip_id",
     *     type="integer",
     *     required=true
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="A single voip",
     *      @SWG\Schema(type="object", @SWG\Items(ref="#/definitions/Voip"))
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function show(VoipRequest $request)
    {
        return $this->itemResponse($request->entity());
    }




    /**
     * @SWG\Post(
     *   path="/voip",
     *   summary="Create a voip",
     *   operationId="createVoip",
     *   tags={"voip"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="voip",
     *     @SWG\Schema(ref="#/definitions/Voip")
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="New voip",
     *      @SWG\Schema(type="object", @SWG\Items(ref="#/definitions/Voip"))
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function store(CreateVoipRequest $request)
    {
        $voip = $this->voipRepo->save($request->input());

        return $this->itemResponse($voip);
    }

    /**
     * @SWG\Put(
     *   path="/voip/{voip_id}",
     *   summary="Update a voip",
     *   operationId="updateVoip",
     *   tags={"voip"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="voip_id",
     *     type="integer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     in="body",
     *     name="voip",
     *     @SWG\Schema(ref="#/definitions/Voip")
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Updated voip",
     *      @SWG\Schema(type="object", @SWG\Items(ref="#/definitions/Voip"))
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function update(UpdateVoipRequest $request, $publicId)
    {
        if ($request->action) {
            return $this->handleAction($request);
        }

        $voip = $this->voipRepo->save($request->input(), $request->entity());

        return $this->itemResponse($voip);
    }


    /**
     * @SWG\Delete(
     *   path="/voip/{voip_id}",
     *   summary="Delete a voip",
     *   operationId="deleteVoip",
     *   tags={"voip"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="voip_id",
     *     type="integer",
     *     required=true
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Deleted voip",
     *      @SWG\Schema(type="object", @SWG\Items(ref="#/definitions/Voip"))
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function destroy(UpdateVoipRequest $request)
    {
        $voip = $request->entity();

        $this->voipRepo->delete($voip);

        return $this->itemResponse($voip);
    }

}
