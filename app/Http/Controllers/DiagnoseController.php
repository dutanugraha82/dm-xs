<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiagnoseController extends Controller
{
    public function index(){
        return view('user.contents.diagnose.index');
    }

    public function storeDiagnose(Request $request){

    }
}
