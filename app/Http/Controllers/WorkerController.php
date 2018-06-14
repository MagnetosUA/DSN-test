<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use File;
use Excel;

class WorkerController extends Controller
{

    public function index()
    {
        return view('load-document');
    }

    public function impExcel(Request $request){
        //validate the xls file
        $this->validate($request, array(
            'file' => 'required'
        ));

        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls") {

                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){

                    foreach ($data as $key => $value) {
                        $insert[] = [
                            'name' => $value['imya'],
                            'last name' => $value['famimliya'],
                            'patronymic' => $value['otchestvo'],
                            'birthday' => $value['god._rozhdeniya'],
                            'salary' => $value['zp_v_god.'] ,
                            'position' => $value['dolzhnost'],
                        ];
                    }

                    if(!empty($insert)){

                        $insertData = DB::table('worcers')->insert($insert);
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                //dump(DB::table('cooperators'));exit;
                return back();

            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }


}
