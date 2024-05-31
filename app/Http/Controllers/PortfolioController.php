<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Expiry;
use App\Models\UnderlyingAsset;
use App\Models\StrikePrice;


class PortfolioController extends Controller
{
    public function index()
    {
       $data = Portfolio::orderBy('_id', 'DESC')->get();

        $activPort = Portfolio::where('status',1)->get();

        $expiries = Expiry::orderBy('underlying','ASC')->orderBy('expiryDate','ASC')->get();

        $scripts = UnderlyingAsset::orderBy('_id','ASC')->get();
       
        $segments = ['Equity', 'Futures', 'Options'];       

        return view('portfolio.index', compact('data','activPort','scripts','segments','expiries'));
    }

    public function create()
    {
        $portData = Portfolio::where('status', '<>', '0')->orderBy('createdAt', 'desc')->get();
        $scripts = ['Script A', 'Script B', 'Script C'];
        $segments = ['Equity', 'Futures', 'Options'];
        $expiries = ['March 2024', 'April 2024', 'May 2024'];
        
        return view('portfolio.create', compact('scripts', 'segments', 'expiries', 'portData'));
    }


   public function store(Request $request)
    {
        // Validation can be added here

        // Process form data and store the position in the database

        // Redirect back to the create page with a success message
        return redirect()->route('portfolio.create')->with('success', 'Position added successfully!');
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
        } 
        catch (ValidationException $e) 
        {
            // Handle validation errors
          return response()->json(['success' => false, 'errors' => $e->validator->errors()->all()], 422);
        } 
        catch (\Exception $e) 
        {
        // Handle any other exceptions (e.g., database errors)
        return response()->json(['success' => false, 'message' => 'Failed to add data. Please try again later.'], 500);
        }
    }


    public function togglePortfolio(Request $request)
    {
    $portfolioId = $request->input('portfolio_id');
    $action = $request->input('action');
    $portfolio = Portfolio::find($portfolioId);
    if (!$portfolio) 
    {
        return response()->json(['error' => 'Portfolio not found'], 404);
    }

    if ($action === 'activate') 
    {
      $portfolio->active = true;
    } 
    elseif ($action === 'deactivate') 
    {
      $portfolio->active = false;
    } 
    else 
    {
      return response()->json(['error' => 'Invalid action'], 400);
    }
    $portfolio->save();

    return response()->json(['message' => 'Portfolio status updated successfully']);
    }

    public function getPortfolioDetails($id)
    {
      $portfolio = Portfolio::findOrFail($id);
      return view('partials.edit_portfolio_form', compact('portfolio'));
    }

    public function ajaxExpiryDetails($id)
    {
      $data = Expiry::where('underlying',$id)->orderBy('expiryDate','ASC')->pluck('expiryDate', '_id'); 
      return response()->json($data);
    }


   public function ajaxStrickDetails($id)
    {
      $data = StrikePrice::where('underlying',$id)->orderBy('strikePrice','ASC')->get();
      return response()->json($data);
    }



    public function updatePortfolio(Request $request)
    {
    
    $portfolio = Portfolio::findOrFail($request->_id);

    $portfolio->update($request->all());
    return redirect()->back()->with([
            'success' => 'Portfolio edited successfully',
            'portfolio_id' => $request->_id,            
        ]);    
    }



}
