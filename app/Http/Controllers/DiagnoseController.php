<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin\Symptoms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnoseController extends Controller
{
    public function index(){
        return view('user.contents.diagnose.index');

    }

    public function storeDiagnose(Request $request){

       $sql = Symptoms::all();
    //    LOW
   
            $lowBak = ($sql[0]->high_end - $request->bak) / ($sql[0]->high_end - $sql[0]->low_start);
            $lowHaus = ($sql[1]->high_end - $request->haus) / ($sql[1]->high_end - $sql[1]->low_start);
            $lowLapar = ($sql[2]->high_end - $request->lapar) / ($sql[2]->high_end - $sql[2]->low_start);
            $lowGds = ($sql[3]->high_end - $request->gds) / ($sql[3]->high_end - $sql[3]->low_start);

    // HIGH

            $highBak = ($request->bak - $sql[0]->low_start) / ($sql[0]->high_end - $sql[0]->low_start);
            $highHaus = ($request->haus - $sql[1]->low_start) / ($sql[1]->high_end - $sql[1]->low_start);
            $highLapar = ($request->lapar - $sql[2]->low_start) / ($sql[2]->high_end - $sql[2]->low_start);
            $highGds = ($request->gds - $sql[3]->low_start) / ($sql[3]->high_end - $sql[3]->low_start);
            
        $minPred1 = min($highBak,$highHaus,$highLapar,$highGds);

        $predicat1 = ($minPred1 * (10-1) - 10) * (-1);


        dd($predicat1);
            
            
            // dd($highGds);

    }
}
