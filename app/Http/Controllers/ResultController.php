<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\DistMaster;
use App\Models\BlockMaster;
use App\Models\PanMaster;
use App\Models\SchemeMaster;


class ResultController extends Controller
{
    public function stateData(Request $request)
    {
    $districts = DistMaster::orderBy('dist_name')->get();
    $data = Result::query();
    if ($request->filled('district')) 
    {
        $data = $data->where('dist_code',(int)$request->district);      
    }
    
    $all           = clone $data;
    $functional    = clone $data;
    $offline       = clone $data;
    $insIOTDevice  = clone $data;
   

    $totalTested = $all->count();
    $totalFun = $functional->whereIn('status',["FUNCTIONAL"])->count();
    $totalOff = $offline->whereIn('status',["OFFLINE"])->count();
    
    $totalInsIOTDevice = $insIOTDevice->distinct('deviceid')
            ->count('deviceid');

    // Sample data
    $data = [
        'totalScheme' => 4774,
        'functionalScheme' => 91.83,
        'nonFunctionalScheme' => 8.17,
        'avgRunningHours' => 0.01,
        'avgElectricHours' => 0.01,
        'fhtc' => 954800,
        'totalHouseholds' => 64500,
        'coverage' => 100,
        'lpcd' => 0.06,
        'totalWards' => 64500,
        'waterConsumption' => 0.07,
        'waterRequirement' => 422737.7,
    ];

    return view('result.stateData', compact('data'));  
    }

    public function deviceAnalyticalDataMonthly(Request $request)
    {
    $districts = DistMaster::orderBy('dist_name')->get();
    $data = Result::query();
    if ($request->filled('district')) 
    {
        $data = $data->where('dist_code',(int)$request->district);
        $targetInsDevice = DistMaster::where('dist_code',(int)$request->district)->first();

        $totalTarInsDevice =$targetInsDevice->target;
    }
    else
    {
        $totalTarInsDevice = DistMaster::sum('target');
    }

    $all           = clone $data;
    $functional    = clone $data;
    $offline       = clone $data;
    $insIOTDevice  = clone $data;
   

    $totalTested = $all->count();
    $totalFun = $functional->whereIn('status',["FUNCTIONAL"])->count();
    $totalOff = $offline->whereIn('status',["OFFLINE"])->count();
    
    $totalInsIOTDevice = $insIOTDevice->distinct('deviceid')
            ->count('deviceid');

    $barChartData = [
        'targetInstalledDevices' => $totalTarInsDevice,
        'installedIOTDevices' => $totalInsIOTDevice,
        'functional' => $totalFun,
        'offline' => $totalOff
    ];        
    // Return the data to the view
    return view('result.deviceAnalyticalDataMonthly', compact('data', 'districts', 'request','totalTested','totalFun','totalOff','totalTarInsDevice','totalInsIOTDevice','barChartData'));
    }


    public function analyticalDataMonthly(Request $request)
    {
    $districts = DistMaster::orderBy('dist_name')->get();
    $data =array();
    foreach ($districts as $key => $value)
    {
        // code...
        $result = Result::query()
                ->where('dist_code',(int)$value->dist_code)->avg('motor_running_hrs');
        $data[$value->dist_code][] =$value->dist_name; 
        $data[$value->dist_code][] =$result ?? 0;        
    }

    //dd($data);


    // Return the data to the view
    return view('result.analyticalDataMonthly', compact('data', 'districts', 'request'));
    }



    public function analyticalSchemeData(Request $request)
    {
       $data = Result::query();
       if ($request->filled('district')) 
       {
         $data = $data->where('dist_code',(int)$request->district);
       }

       $all         = clone $data;
       $functional  = clone $data;
       $offline     = clone $data;

       $totalTested = $all->count();
       $totalFun = $functional->whereIn('status',["FUNCTIONAL"])->count();
       $totalOff = $offline->whereIn('status',["OFFLINE"])->count();

       $districts = DistMaster::all();
       return view('result.analyticalSchemeData', compact('data','districts','request','totalTested','totalFun','totalOff'));
    }



    public function index(Request $request)
    {
       $data = Result::query();
       if ($request->filled('district')) 
       {
         $data = $data->where('dist_code',(int)$request->district);
       }
       if ($request->filled('block')) 
       {
         $data = $data->where('block_code', (int)$request->block);
       }
       if ($request->filled('panchayat')) 
       {
          $data = $data->where('pan_code',(int)$request->panchayat);
       }
       if ($request->filled('scheme_name'))
       {
          $data = $data->where('scheme_id',$request->scheme);
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
        $scheme = SchemeMaster::all();     

        return view('result.index', compact('data', 'districts', 'blocks', 'panchayats','scheme','request'));
    }

    public function getBlocks(Request $request)
    {

        $blocks = BlockMaster::where('dist_code',(int)$request->dist_code)->orderBy('block_name')->get();
        return response()->json($blocks);
    }

    public function getPanchayats(Request $request)
    {
        $panchayats = PanMaster::where('block_code',(int)$request->block_code)->orderBy('pan_name')->get();
        return response()->json($panchayats);
    }

    public function getScheme(Request $request)
    {
        $scheme = SchemeMaster::where('scheme_id',(int)$request->scheme_id)->orderBy('scheme_name')->get();
        return response()->json($scheme);
    }
}
