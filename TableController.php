<?php

namespace App\Http\Controllers;

use ImportExport;

use App\Models\Table;
use Illuminate\Http\Request;

class VendorTipeController extends Controller
{
    protected $export;
    public function __construct()
    {
        $this->middleware('auth');
        $this->export   = new ImportExport;
    }


    // export pdf & Excel
    public function export($type)
    {
        $data = Table::all();

        if($type == 'pdf')
            return $this->export->exportPDF('_reports.table', 'portrait', 'a4', $data);
        elseif($type == 'excel')
            return $this->export->exportExcel('Data Table', 'Table', '_reports.table', 'portrait', $data);
    }

   
}
