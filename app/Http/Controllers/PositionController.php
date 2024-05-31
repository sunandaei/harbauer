<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Position;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        $portData = Portfolio::where('status', '<>', '0')->orderBy('createdAt', 'desc')->get();
        $scripts = ['Script A', 'Script B', 'Script C'];
        $segments = ['Equity', 'Futures', 'Options'];
        $expiries = ['March 2024', 'April 2024', 'May 2024'];
        
        return view('positions.create', compact('scripts', 'segments', 'expiries', 'portData'));


    }

   public function store(Request $request)
{
    

    // Validate the incoming request
    $validatedData = $request->validate([
        'script' => 'required|string',
        'segment' => 'required|string',
        'expiry' => 'required|string',
        'entry_price' => 'required|numeric|min:0',
        'current_price' => 'required|numeric|min:0',
        'exit_price' => 'required|numeric|min:0',
        'action' => 'required|in:buy,sell',
    ]);

    // If segment is "Options", add additional validation rules and fields
    if ($request->segment === 'Options') {
        $additionalValidation = $request->validate([
            'option' => 'required|string|in:call,put',
            'strickOption' => 'required|numeric',
        ]);

        // Merge the additional validated data with the initial validated data
        $validatedData = array_merge($validatedData, $additionalValidation);
    }

    // Attempt to create a new portfolio record
    try {
        $validatedData['portfolio_id'] = $request->input('portfolio_id');   

        $validatedData['note'] = $request->input('note');

        Position::create($validatedData);
        
        // Redirect on success
        return redirect()->back()->with([
            'success' => 'Position added successfully',
            'portfolio_id' => $request->input('portfolio_id'),            
        ]);
    } catch (\Exception $e) {
        // Handle any exceptions (e.g., database errors)
        return redirect()->back()->withInput()->withErrors(['error' => 'Failed to add position. Please try again later.']);
    }
}



    public function show($id)
    {
        $position = Position::findOrFail($id);
        return view('positions.show', compact('position'));
    }

    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);


        $validatedData = $request->validate([
        'script' => 'required|string',
        'segment' => 'required|string',
        'expiry' => 'required|string',
        'entry_price' => 'required|numeric|min:0',
        'current_price' => 'required|numeric|min:0',
        'exit_price' => 'required|numeric|min:0',
        'action' => 'required|in:buy,sell',
        ]);

        // Additional validation for Options segment
        if ($request->segment === 'Options') 
        {
        $additionalValidation = $request->validate([
            'option' => 'required|string|in:call,put',
            'strickOption' => 'required|numeric',
            ]);

            $validatedData = array_merge($validatedData, $additionalValidation);
        }

        try 
        {
        $position = Position::findOrFail($id);

         $validatedData['note'] = $request->input('note');
        $position->update($validatedData);
        return redirect()->back()->with([
            'success' => 'Position updated successfully',
            'portfolio_id' => $position->portfolio_id,
            ]);
        } 
        catch (\Exception $e) 
        {
        return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update position. Please try again later.']);
        }
    }

  public function destroy($id)
    {
        // Find the position by its ID
        $position = Position::findOrFail($id);
        // Delete the position
        $position->delete();
        // Redirect back with a success message
        return redirect()->route('position.index')->with('success', 'Position deleted successfully');
    }

    public function deleteSelected(Request $request)
    {   
        try 
        {

            $request->validate([
                'selectedPositions.*' => 'exists:positions,_id', // Validate each requested _id
            ]);

            $selectedPositions = json_decode($request->selectedPositions);

            $deleteCount = Position::whereIn('_id', $selectedPositions)->delete();
             if ($deleteCount > 0) 
             {
                return redirect()->route('position.index')->with('success', "$deleteCount positions deleted successfully.");
            } 
            else 
            {
                // Log an error message for troubleshooting
                Log::warning("No positions were deleted (might be related to foreign key constraints or other DB issues).");
                return redirect()->route('position.index')->with('error', 'An error occurred while deleting positions. Please check the logs for details.');
            }
        } 
        catch (\Exception $e) 
        {
         Log::error('Error deleting positions: ' . $e->getMessage());
         return redirect()->route('position.index')->with('error', 'An error occurred while deleting positions. Please try again later.');
        }
    }


    public function edittable()
    {
       
        return view('positions.edit');
    }

    public function getPositionDetails($positionId)
    {
    $position = Position::findOrFail($positionId);
    $scripts = ['Script A', 'Script B', 'Script C'];
    $segments = ['Equity', 'Futures', 'Options'];
    $expiries = ['March 2024', 'April 2024', 'May 2024'];
    
    return view('partials.edit_position_form')->with([
        'position' => $position,
        'scripts' => $scripts,
        'segments' => $segments,
        'expiries' => $expiries,
    ]);
    }


}
