<?php
/**
 *
 */

namespace App\Libraries;
use Excel, PDF;

class ImportExport
{
    // -----------------------------------------------------
    // download format
    // -----------------------------------------------------
    public static function download($type, $sheet, $view, $page)
    {
        // initial
        $filetype  = $type;
        $viewname  = $view;
        $pagetype  = $page;
        $sheetname = strtoupper($sheet);
        $filename  = 'FORMAT-IMPORT-'.$sheetname;

        return Excel::create($filename, function($excel) {
            $excel->sheet($sheetname, function($sheet)
            {
                // tambah data ke sheet
                // $sheet->with($data);
                $sheet->loadView($viewname);

                $sheet->setOrientation($pagetype);
            });

        })->download($filetype);
    }

    // -----------------------------------------------------
    // export data
    // -----------------------------------------------------
    public function exportPDF($view, $page, $size, $data)
    {
        return PDF::loadView($view, compact('data'))
                    ->setPaper($size, $page)
                    ->stream();
    }

    public function exportExcel($filename, $sheetname, $view, $page, $data)
    {
        return Excel::create($filename, function($excel) use ($data, $sheetname, $view, $page) {
            $excel->sheet($sheetname, function($sheet) use ($data, $view, $page)
            {
                $sheet->loadView($view, compact('data'));
                $sheet->setOrientation($page);
                $sheet->setAutoSize(true);
                $sheet->setShowGridlines(false);
                $sheet->setHeight(array(
                    1 => 20, 2 => 20, 3 => 20, 5 => 18
                ));
                $sheet->setBorder('A4:H26', 'thin', "D8572C");
            });

        })->download('xlsx');
    }

    // -----------------------------------------------------
    // import data
    // -----------------------------------------------------
    public static function import(Request $request, $table)
    {
        // initial
        $tablename = $table;

         // truncate table
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
         DB::table($tablename)->truncate();
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');

         // Get current data from items table
 	 	 $nama = Pegawai::pluck('nama')->toArray();

 	 	 if(Input::hasFile('file')){
 	 		  $path = Input::file('file')->getRealPath();
 	 		  $data = Excel::load($path, function($reader) {
 	 		  })->get();

 	 		  if(!empty($data) && $data->count()){
 	 				$insert = array();

 	 				foreach ($data as $key => $value) {
 	 					 // Skip title previously added using in_array
 	 					 if (in_array($value->nama, $nama))
 	 						  continue;

 	 					 $insert[] = [
 							  'no_ktp'     => $value->no_ktp,
 							  'nama'       => $value->nama,
 	 						  'nohp'       => $value->nohp,
 	 					 ];

 	 					 // Add new title to array
 	 					 $nama[] = $value->nama;
 	 				}

 	 				if(!empty($insert)){
 	 					 DB::table('pegawai')->insert($insert);
 	 				}
 	 		  }
 	 	 }

 	 	 return back();
    }
}
 ?>
