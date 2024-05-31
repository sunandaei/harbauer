<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Position;
use App\Models\Script;
use App\Models\Expiry;
use App\Models\StrikePrice;
use App\Models\UnderlyingAsset;
use App\Models\OptionNifty;
use App\Models\OptionChainCurrent;


class OptionController extends Controller
{
 public function index()
 {
	$data = OptionNifty::where('underlying','NIFTY')
	 		->orderBy('_id', 'DESC')
	 		->paginate(1000);
	return view('options.index', compact('data'));
 }
}