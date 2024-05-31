<?php
// HomeController.php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str; 
use Illuminate\Validation\ValidationException;

use App\Models\Portfolio;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function ajaxPortfolioSave(Request $request)
{
    try {
              
      $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

      

      $portfolio = new Portfolio;
      $portfolio->name=$request->name;
      $portfolio->type=$request->type;
      $portfolio->interval=$request->interval;
      $portfolio->remarks=$request->remarks;
      $portfolio->status=(int)1;

      $portfolio->save();
      return response()->json(['success' => true, 'message' => 'Data added successfully']);
    } catch (ValidationException $e) {
        // Handle validation errors
        return response()->json(['success' => false, 'errors' => $e->validator->errors()->all()], 422);
    } catch (\Exception $e) {
        // Handle any other exceptions (e.g., database errors)
        return response()->json(['success' => false, 'message' => 'Failed to add data. Please try again later.'], 500);
    }
}


    // Add more methods as needed
}
