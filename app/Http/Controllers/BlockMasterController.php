<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlockMasterController extends Controller
{
   public function index()
    {
        $data = BlockMaster::all();
        return view('masters.BlockMaster.index', compact('data'));
    }

    public function create()
    {
        return view('masters.BlockMaster.create');
    }

    public function store(Request $request)
    {
        BlockMaster::create($request->all());
        return redirect()->route('BlockMaster.index');
    }

    public function edit($id)
    {
        $data = BlockMaster::findOrFail($id);
        return view('masters.BlockMaster.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = BlockMaster::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('BlockMaster.index');
    }

    public function destroy($id)
    {
        $data = BlockMaster::findOrFail($id);
        $data->delete();
        return redirect()->route('BlockMaster.index');
    }
}
