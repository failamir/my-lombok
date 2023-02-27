<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEtalaseRequest;
use App\Http\Requests\UpdateEtalaseRequest;
use App\Http\Resources\Admin\EtalaseResource;
use App\Models\Etalase;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EtalaseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('etalase_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EtalaseResource(Etalase::all());
    }

    public function store(StoreEtalaseRequest $request)
    {
        $etalase = Etalase::create($request->all());

        return (new EtalaseResource($etalase))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Etalase $etalase)
    {
        abort_if(Gate::denies('etalase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EtalaseResource($etalase);
    }

    public function update(UpdateEtalaseRequest $request, Etalase $etalase)
    {
        $etalase->update($request->all());

        return (new EtalaseResource($etalase))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Etalase $etalase)
    {
        abort_if(Gate::denies('etalase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $etalase->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
