<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelDataImport; // Import your import class here


class ExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function uploadExcel(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,csv,xls',
        ]);

        try {
            // Handle the uploaded file
            Excel::import(new ExcelDataImport, $request->file('excel_file'));

            // Redirect with success message
            return redirect()->back()->with('success', 'Excel file uploaded and data imported successfully!');
        } catch (\Exception $e) {
            // Log any errors for debugging
            \Log::error('Error during import: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error during import: ' . $e->getMessage()]);
        }
    }

    public function showUploadForm(Request $request)
    {
        return view('result.upload');  
    }
}
