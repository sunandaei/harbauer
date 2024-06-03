<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VillMasterController extends Controller
{
    public function index()
    {
        $data = VillMaster::all();
        return view('masters.VillMaster.index', compact('data'));
    }

    public function create()
    {
        return view('masters.VillMaster.create');
    }

    public function store(Request $request)
    {
        VillMaster::create($request->all());
        return redirect()->route('VillMaster.index');
    }

    public function edit($id)
    {
        $data = VillMaster::findOrFail($id);
        return view('masters.VillMaster.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = VillMaster::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('VillMaster.index');
    }

    public function destroy($id)
    {
        $data = VillMaster::findOrFail($id);
        $data->delete();
        return redirect()->route('VillMaster.index');
    }
}
