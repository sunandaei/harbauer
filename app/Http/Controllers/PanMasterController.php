<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanMasterController extends Controller
{
    public function index()
    {
        $data = PanMaster::all();
        return view('masters.PanMaster.index', compact('data'));
    }

    public function create()
    {
        return view('masters.PanMaster.create');
    }

    public function store(Request $request)
    {
        PanMaster::create($request->all());
        return redirect()->route('PanMaster.index');
    }

    public function edit($id)
    {
        $data = PanMaster::findOrFail($id);
        return view('masters.PanMaster.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = PanMaster::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('PanMaster.index');
    }

    public function destroy($id)
    {
        $data = PanMaster::findOrFail($id);
        $data->delete();
        return redirect()->route('PanMaster.index');
    }
}