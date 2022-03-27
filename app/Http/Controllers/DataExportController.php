<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DataExport;
use App\User;
use Maatwebsite\Excel\Facades\Excel;

class DataExportController extends Controller
{
    public function importExportView()
    {
       return view('import');
    }
   
    public function export() 
    {
        return Excel::download((new DataExport('40')), 'Vehicles.xlsx');
    }
   
    // public function import() 
    // {
    //     Excel::import(new UsersImport,request()->file('file'));
           
    //     return redirect()->back();
    // }
}
