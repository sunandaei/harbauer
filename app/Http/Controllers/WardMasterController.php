<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WardMasterController extends Controller
{
   public function index()
    {
        $data = WardMaster::all();
        return view('masters.WardMaster.index', compact('data'));
    }

    public function create()
    {
        return view('masters.WardMaster.create');
    }

    public function store(Request $request)
    {
        WardMaster::create($request->all());
        return redirect()->route('WardMaster.index');
    }

    public function edit($id)
    {
        $data = WardMaster::findOrFail($id);
        return view('masters.WardMaster.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = WardMaster::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('WardMaster.index');
    }

    public function destroy($id)
    {
        $data = WardMaster::findOrFail($id);
        $data->delete();
        return redirect()->route('WardMaster.index');
    }
}
