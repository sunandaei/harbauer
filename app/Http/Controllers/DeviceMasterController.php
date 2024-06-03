<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceMasterController extends Controller
{
    public function index()
    {
        $data = DeviceMaster::all();
        return view('masters.DeviceMaster.index', compact('data'));
    }

    public function create()
    {
        return view('masters.DeviceMaster.create');
    }

    public function store(Request $request)
    {
        DeviceMaster::create($request->all());
        return redirect()->route('DeviceMaster.index');
    }

    public function edit($id)
    {
        $data = DeviceMaster::findOrFail($id);
        return view('masters.DeviceMaster.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = DeviceMaster::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('DeviceMaster.index');
    }

    public function destroy($id)
    {
        $data = DeviceMaster::findOrFail($id);
        $data->delete();
        return redirect()->route('DeviceMaster.index');
    }
}