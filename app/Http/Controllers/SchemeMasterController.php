<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchemeMasterController extends Controller
{
    public function index()
    {
        $data = SchemeMaster::all();
        return view('masters.SchemeMaster.index', compact('data'));
    }

    public function create()
    {
        return view('masters.SchemeMaster.create');
    }

    public function store(Request $request)
    {
        SchemeMaster::create($request->all());
        return redirect()->route('SchemeMaster.index');
    }

    public function edit($id)
    {
        $data = SchemeMaster::findOrFail($id);
        return view('masters.SchemeMaster.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = SchemeMaster::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('SchemeMaster.index');
    }

    public function destroy($id)
    {
        $data = SchemeMaster::findOrFail($id);
        $data->delete();
        return redirect()->route('SchemeMaster.index');
    }
}