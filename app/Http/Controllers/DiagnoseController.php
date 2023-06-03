<?php

namespace App\Http\Controllers;

use App\Models\Results;
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
        $minPred2 = min($highBak,$lowHaus,$highLapar,$highGds);
        $minPred3 = min($lowBak,$lowHaus,$highLapar,$lowGds);
        $minPred4 = min($lowBak,$highHaus,$highLapar,$lowGds);
        $minPred5 = min($highBak, $highHaus, $highLapar, $lowGds);
        $minPred6 = min($lowBak,$lowHaus,$lowLapar,$highGds);

        // R1 HighBak,HighHaus,HighLapar,HighGds then positive DM
        // R2 HighBak, LowHaus, HighLapar, HighGds then positive DM
        // R3 lowBak, LowHaus, HighLapar, LowGds then negative DM
        // R4 lowBak, HighHaus, HighLapar, lowGds then negative DM
        // R5 HighBak, HighHaus, HighLapar, lowGds then negativeDM
        // R6 lowBak, lowHaus, lowLapar, HighGDs then positive DM
        $predicat1 = ($minPred1 * (10-1) - 10) * (-1);
        $predicat2 = ($minPred2 * (10-1) - 10) * (-1);
        $predicat3 = ($minPred3 * (10-1) - 10) * (-1) ;
        $predicat4 = ($minPred4 * (10-1) - 10) * (-1);
        $predicat5 = ($minPred5 * (10-1) - 10) * (-1);
        $predicat6 = ($minPred6 * (10-1) - 10) * (-1);

        $z = (($minPred1 * $predicat1) + ($minPred2 * $predicat2) + ($minPred3 * $predicat3) + ($minPred4 * $predicat4) + ($minPred5 * $predicat5) + ($minPred6 * $predicat6)) / ($minPred1+$minPred2+$minPred3+$minPred4+$minPred5+$minPred6);


        if ($request->bak >= $sql[0]->high_start || $request->haus >= $sql[1]->high_start || $request->lapar >= $sql[2]->low_end || $request->gds >= $sql[3]->high_end || $request->gds > 199) {
            Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda positive, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka tinggi pada sistem,'
            ]);
        }elseif ($request->bak >= $sql[0]->high_start || $request->haus <= $sql[1]->low_end || $request->lapar >= $sql[2]->low_end || $request->gds >= $sql[3]->high_end || $request->gs > 199) {
            echo 'positive DM with score: ' . $z;
        }elseif ($request->bak <= $sql[0]->low_end || $request->haus <= $sql[1]->low_end || $request->lapar >= $sql[2]->low_end || $request->gds <= $sql[3]->high_end || $request->gds < 200) {
            echo 'negative dm';
        }elseif ($request->bak <= $sql[0]->low_end || $request->haus <= $sql[1]->high_start || $request->lapar >= $sql[2]->low_end || $request->gds < $sql[3]->high_end || $request->gds < 200) {
            echo 'negative dm';
        }elseif ($request->bak >= $sql[0]->high_start || $request->haus >= $sql[1]->high_start || $request->lapar >= $sql[2]->low_end || $request->gds < $sql[3]->high_end || $request->gds < 200) {
            echo 'negative dm';
        }elseif ($request->bak < $sql[0]->high_start || $request->haus < $sql[1]->high_start || $request->lapar < $sql[2]->high_start || $request->gds >= $sql[3]->high_end || $request->gds > 199) {
            echo 'negative dm';
        }
        

            

    }
}
