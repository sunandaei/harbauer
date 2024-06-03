<?php

namespace App\Http\Controllers;

use App\Models\DistMaster;
use Illuminate\Http\Request;

class DistMasterController extends Controller
{
    public function index()
    {
        $data = DistMaster::all();
        return view('masters.distMaster.index', compact('data'));
    }

    public function create()
    {
        return view('masters.distMaster.create');
    }

    public function store(Request $request)
    {
        DistMaster::create($request->all());
        return redirect()->route('distMaster.index');
    }

    public function edit($id)
    {
        $data = DistMaster::findOrFail($id);
        return view('masters.distMaster.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = DistMaster::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('distMaster.index');
    }

    public function destroy($id)
    {
        $data = DistMaster::findOrFail($id);
        $data->delete();
        return redirect()->route('distMaster.index');
    }
}
