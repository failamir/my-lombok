<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEtalaseRequest;
use App\Http\Requests\StoreEtalaseRequest;
use App\Http\Requests\UpdateEtalaseRequest;
use App\Models\Etalase;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EtalaseController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('etalase_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $etalases = Etalase::all();

        return view('admin.etalases.index', compact('etalases'));
    }

    public function create()
    {
        abort_if(Gate::denies('etalase_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.etalases.create');
    }

    public function store(StoreEtalaseRequest $request)
    {
        $etalase = Etalase::create($request->all());

        return redirect()->route('admin.etalases.index');
    }

    public function edit(Etalase $etalase)
    {
        abort_if(Gate::denies('etalase_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.etalases.edit', compact('etalase'));
    }

    public function update(UpdateEtalaseRequest $request, Etalase $etalase)
    {
        $etalase->update($request->all());

        return redirect()->route('admin.etalases.index');
    }

    public function show(Etalase $etalase)
    {
        abort_if(Gate::denies('etalase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.etalases.show', compact('etalase'));
    }

    public function destroy(Etalase $etalase)
    {
        abort_if(Gate::denies('etalase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $etalase->delete();

        return back();
    }

    public function massDestroy(MassDestroyEtalaseRequest $request)
    {
        $etalases = Etalase::find(request('ids'));

        foreach ($etalases as $etalase) {
            $etalase->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
