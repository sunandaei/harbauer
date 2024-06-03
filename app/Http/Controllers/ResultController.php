<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\DistMaster;
use App\Models\BlockMaster;
use App\Models\PanMaster;


class ResultController extends Controller
{
    public function index(Request $request)
    {
       $data = Result::query();
       if ($request->filled('district')) 
       {
         $data = $data->where('dist_name', $request->district);
       }
       if ($request->filled('block')) 
       {
         $data = $data->where('block_name', $request->block);
       }
       if ($request->filled('panchayat')) 
       {
          $data = $data->where('pan_name', $request->panchayat);
       }
       if ($request->filled('scheme_name'))
       {
          $data = $data->where('scheme_name', 'like', '%' . $request->scheme_name . '%');
       }
       if ($request->filled('scheme_type'))
       {
          $data = $data->where('scheme_type', $request->scheme_type);
       }
       if ($request->filled('status')) 
       {
          $data = $data->where('status', $request->status);
       }


       $data =$data->orderBy('dist_name', 'DESC')
            ->orderBy('block_name', 'DESC')
            ->orderBy('pan_name', 'DESC')
            ->get();  

        $districts = DistMaster::all();
        $blocks = BlockMaster::all();
        $panchayats = PanMaster::all();    

        return view('portfolio.index', compact('data', 'districts', 'blocks', 'panchayats'));
    }

    public function getBlocks(Request $request)
    {
        $blocks = BlockMaster::where('district_id', $request->district_id)->get();
        return response()->json($blocks);
    }

    public function getPanchayats(Request $request)
    {
        $panchayats = PanMaster::where('block_id', $request->block_id)->get();
        return response()->json($panchayats);
    }
}
