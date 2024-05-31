<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Result;


class ResultController extends Controller
{
    public function index()
    {
       $data = Result::orderBy('dist_name', 'DESC')
            ->orderBy('block_name', 'DESC')
            ->orderBy('pan_name', 'DESC')
            ->get();  

         dd($data):           

        return view('result.index', compact('data'));
    }


}
