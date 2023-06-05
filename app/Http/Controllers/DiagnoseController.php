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
        $minPred7 = min($lowBak, $lowHaus, $highLapar, $highGds);
        $minPred8 = min($highBak, $highHaus, $lowLapar, $highGds);
        $minPred9 = min($highBak, $highHaus, $lowLapar, $lowGds);
        $minPred10 = min($highBak, $lowBak, $lowLapar, $lowGds);
        $minPred11 = min($highBak, $lowHaus, $highLapar, $lowGds);
        $minPred12 = min($highBak, $lowHaus, $lowLapar, $highGds);
        $minPred13 = min($lowBak, $lowHaus, $lowLapar, $lowGds);
        $minPred14 = min($lowBak, $highHaus, $highLapar, $highGds);
        $minPred15 = min($lowBak, $highHaus, $lowLapar, $lowGds);
        $minPred16 = min($lowBak, $highHaus, $lowLapar, $highGds);

        // R1 HighBak,HighHaus,HighLapar,HighGds then positive DM
        // R2 HighBak, LowHaus, HighLapar, HighGds then positive DM
        // R3 lowBak, LowHaus, HighLapar, LowGds then negative DM
        // R4 lowBak, HighHaus, HighLapar, lowGds then negative DM
        // R5 HighBak, HighHaus, HighLapar, lowGds then negativeDM
        // R6 lowBak, lowHaus, lowLapar, HighGDs then positive DM
        // R7 LowBak, LowHaus, HighLapar, HighGds then positive DM
        // R8 HighBak, HighHaus, LowLapar, HighGds Then Positive DM
        // R9 HighBak, HighHaus, LowLapar, LowGds Then Positive DM
        // R10 HighBak, lowhaus, lowLapara, LowGds Then Negative DM
        // R11 HighBak, lowhaus, HighLapar, LowGds then negative DM
        // R12 HighBak, lowhaus, lowLapar, HighGds then positive DM
        // R13 lowBak, lowhaus, lowLapar, lowGds then negative DM
        // R14 lowBak, highhaus, highLapar, highGds then positive DM
        // R15 lowBak, highhaus, lowLapar, lowGds then negative DM
        // R16 lowBak, highhaus, lowLapar, highGds then positive DM

        $predicat1 = ($minPred1 * (10-1) - 10) * (-1);
        $predicat2 = ($minPred2 * (10-1) - 10) * (-1);
        $predicat3 = ($minPred3 * (10-1) - 10) * (-1);
        $predicat4 = ($minPred4 * (10-1) - 10) * (-1);
        $predicat5 = ($minPred5 * (10-1) - 10) * (-1);
        $predicat6 = ($minPred6 * (10-1) - 10) * (-1);
        $predicat7 = ($minPred7 * (10-1) - 10) * (-1);
        $predicat8 = ($minPred8 * (10-1) - 10) * (-1);
        $predicat9 = ($minPred9 * (10-1) - 10) * (-1);
        $predicat10 = ($minPred10 * (10-1) - 10) * (-1);
        $predicat11 = ($minPred11 * (10-1) - 10) * (-1);
        $predicat12 = ($minPred12 * (10-1) - 10) * (-1);
        $predicat13 = ($minPred13 * (10-1) - 10) * (-1);
        $predicat14 = ($minPred14 * (10-1) - 10) * (-1);
        $predicat15 = ($minPred15 * (10-1) - 10) * (-1);
        $predicat16 = ($minPred16 * (10-1) - 10) * (-1);

        $z = (($minPred1 * $predicat1) + ($minPred2 * $predicat2) + ($minPred3 * $predicat3) + ($minPred4 * $predicat4) + ($minPred5 * $predicat5) + ($minPred6 * $predicat6) + ($minPred7 * $predicat7) + ($minPred8 * $predicat8) + ($minPred9 * $predicat9) + ($minPred10 * $predicat10) + ($minPred11 * $predicat11) + ($minPred12 * $predicat12) + ($minPred13 * $predicat13) + ($minPred14 * $predicat14) + ($minPred15 * $predicat15) + ($minPred16 * $predicat16)) / ($minPred1+$minPred2+$minPred3+$minPred4+$minPred5+$minPred6+$minPred7+$minPred8+$minPred9+$minPred10+$minPred11+$minPred12+$minPred13+$minPred14+$minPred15+$minPred16);

        
        
        if ($request->bak >= $sql[0]->low_end && $request->haus >= $sql[1]->low_end && $request->lapar >= $sql[2]->low_end && $request->gds > 199) {
        $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>positive</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka tinggi pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka tinggi pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka tinggi pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka tinggi pada sistem.Hasil skor positive diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter, perbaiki pola makan anda, dan jangan lupa olah raga yang rutin.',
                'status_dm' => 'positive',
            ])->id;

            return redirect('/results'.'/'.$id);

        }elseif ($request->bak >= $sql[0]->low_end && $request->haus <= $sql[1]->low_end && $request->lapar >= $sql[2]->low_end && $request->gs > 199) {
           $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>positive</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka tinggi pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka rendah pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka tinggi pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka tinggi pada sistem.Hasil skor positive diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter, perbaiki pola makan anda, jangan lupa olah raga yang rutin ya, dan penuhi asupan minum anda.',
                'status_dm' => 'positive',
            ])->id;

            return redirect('/results'.'/'.$id);

        }elseif ($request->bak <= $sql[0]->low_end && $request->haus <= $sql[1]->low_end && $request->lapar >= $sql[2]->low_end &&  $request->gds < 200) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>negative</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka rendah pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka rendah pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka tinggi pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka rendah pada sistem.Hasil skor negative diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter, perbaiki pola makan anda, jangan lupa olah raga yang rutin, dan penuhi asupan minum anda.',
                'status_dm' => 'negative',
            ])->id;

            return redirect('/results'.'/'.$id);

        }elseif ($request->bak <= $sql[0]->low_end && $request->haus <= $sql[1]->low_end && $request->lapar >= $sql[2]->low_end && $request->gds < 200) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>negative</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka rendah pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka tinggi pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka tinggi pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka rendah pada sistem.Hasil skor negative diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda, jangan lupa olah raga yang rutin, dan jangan lupa penuhi kebutuhan serat tubuh agar sistem metabolisme anda teratur.',
                'status_dm' => 'negative',
            ])->id;

            return redirect('/results'.'/'.$id);

        }elseif ($request->bak >= $sql[0]->low_end && $request->haus >= $sql[1]->low_end && $request->lapar >= $sql[2]->low_end && $request->gds < 200) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>negative</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka tinggi pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka tinggi pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka tinggi pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka rendah pada sistem.Hasil skor negative diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda dan jangan lupa olah raga yang rutin.',
                'status_dm' => 'negative',
            ])->id;

            return redirect('/results'.'/'.$id);

        }elseif ($request->bak <= $sql[0]->low_end && $request->haus <= $sql[1]->low_end && $request->lapar <= $sql[2]->low_end && $request->gds > 199) {
             $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>positive</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka rendah pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka rendah pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka rendah pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka tinggi pada sistem.Hasil skor positive diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda, jangan lupa olah raga yang rutin, perbaiki pola makan dan tidur anda.',
                'status_dm' => 'positive',
            ])->id;
            
            return redirect('/results'.'/'.$id);

        }elseif ($request->bak <= $sql[0]->low_end && $request->haus <= $sql[1]->low_end && $request->lapar >= $sql[2]->low_end && $request->gds > 199) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>positive</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka rendah pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka rendah pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka tinggi pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka tinggi pada sistem.Hasil skor positive diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda, jangan lupa olah raga yang rutin, perbaiki pola makan dan tidur anda.',
                'status_dm' => 'positive',
            ])->id;
            return redirect('/results'.'/'.$id);

        }elseif ($request->bak >= $sql[0]->low_end && $request->haus >= $sql[1]->low_end && $request->lapar <= $sql[2]->high_start && $request->gds > 199) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>positive</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka tinggi pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka tinggi pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka rendah pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka tinggi pada sistem. Hasil skor positive diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda seperti merasa kelelahan, jangan lupa olah raga yang rutin, perbaiki pola makan dan tidur anda.',
                'status_dm' => 'positive',
            ])->id;
            return redirect('/results'.'/'.$id);

        }elseif ($request->bak >= $sql[0]->low_end && $request->haus >= $sql[1]->low_end && $request->lapar <= $sql[2]->high_start && $request->gds < 199) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>Negative</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka tinggi pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka tinggi pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka rendah pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka rendah pada sistem. Hasil skor negative diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda seperti merasa kelelahan, jangan lupa olah raga yang rutin, perbaiki pola makan dan tidur anda.',
                'status_dm' => 'negative',
            ])->id;
            return redirect('/results'.'/'.$id);
        
        }elseif ($request->bak >= $sql[0]->low_end && $request->haus <= $sql[1]->low_end && $request->lapar <= $sql[2]->high_start && $request->gds < 199) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>Negative</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka tinggi pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka rendah pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka rendah pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka rendah pada sistem. Hasil skor negative diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda seperti merasa kelelahan, jangan lupa olah raga yang rutin, perbaiki pola makan dan tidur anda.',
                'status_dm' => 'negative',
            ])->id;
            return redirect('/results'.'/'.$id);

        }elseif ($request->bak >= $sql[0]->low_end && $request->haus <= $sql[1]->low_end && $request->lapar >= $sql[2]->high_start && $request->gds < 199) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>Negative</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka tinggi pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka rendah pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka tinggi pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka rendah pada sistem. Hasil skor negative diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda seperti merasa kelelahan, jangan lupa olah raga yang rutin, perbaiki pola makan dan tidur anda.',
                'status_dm' => 'negative',
            ])->id;
            return redirect('/results'.'/'.$id);

        }elseif ($request->bak >= $sql[0]->low_end && $request->haus <= $sql[1]->low_end && $request->lapar <= $sql[2]->high_start && $request->gds > 199) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>Positive</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka tinggi pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka rendah pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka rendah pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka tinggi pada sistem. Hasil skor positive diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda seperti merasa kelelahan, jangan lupa olah raga yang rutin, perbaiki pola makan dan tidur anda.',
                'status_dm' => 'positive',
            ])->id;
            return redirect('/results'.'/'.$id);
        }elseif ($request->bak <= $sql[0]->low_end && $request->haus <= $sql[1]->low_end && $request->lapar <= $sql[2]->high_start && $request->gds < 199) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>Negative</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka rendah pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka rendah pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka rendah pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka rendah pada sistem. Hasil skor negative diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda seperti merasa kelelahan, jangan lupa olah raga yang rutin, perbaiki pola makan dan tidur anda.',
                'status_dm' => 'positive',
            ])->id;
            return redirect('/results'.'/'.$id);
        }elseif ($request->bak <= $sql[0]->low_end && $request->haus >= $sql[1]->low_end && $request->lapar >= $sql[2]->high_start && $request->gds > 199) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>Positive</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka rendah pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka tinggi pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka tinggi pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka tinggi pada sistem. Hasil skor positive diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda seperti merasa kelelahan, jangan lupa olah raga yang rutin, perbaiki pola makan dan tidur anda.',
                'status_dm' => 'positive',
            ])->id;
            return redirect('/results'.'/'.$id);

        }elseif ($request->bak <= $sql[0]->low_end && $request->haus >= $sql[1]->low_end && $request->lapar <= $sql[2]->high_start && $request->gds < 199) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>Negative</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka rendah pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka tinggi pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka rendah pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka rendah pada sistem. Hasil skor negative diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda seperti merasa kelelahan, jangan lupa olah raga yang rutin, perbaiki pola makan dan tidur anda.',
                'status_dm' => 'negative',
            ])->id;
            return redirect('/results'.'/'.$id);
        }elseif ($request->bak <= $sql[0]->low_end && $request->haus >= $sql[1]->low_end && $request->lapar <= $sql[2]->high_start && $request->gds > 199) {
            $id =  Results::create([
                'users_id' => auth()->user()->id,
                'conclusion' => 'Status Diabetes anda <b>Positive</b>, dimana hal tersebut dikarenakan jumlah buang air kecil anda: '. $request->bak.' dimana hasil tersebut menunjukan angka rendah pada sistem, jumlah rasa haus anda dalam perhari adalah: '.$request->haus.' dimana angka tersebut menunjukan angka tinggi pada sistem, jumlah rasa lapar anda dalam perhari adalah: '.$request->lapar.'dimana angka tersebut menunjukan angka rendah pada sistem, dan hasil Gula Darah Sewaktu anda menunjukkan angka: '.$request->gds.'dimana angka tersebut menunjukan angka tinggi pada sistem. Hasil skor positive diabetes anda menunjukan angka: '.substr($z,0,1).'</br>Saran dari kami adalah segera konsultasi ke dokter lebih lanjut bila merasakan hal yang aneh pada tubuh anda seperti merasa kelelahan, jangan lupa olah raga yang rutin, perbaiki pola makan dan tidur anda.',
                'status_dm' => 'Positive',
            ])->id;
            return redirect('/results'.'/'.$id);
        }
        else{
               print_r('error');
           
        }
        

            

    }

    public function results($id){
       $data = Results::find($id);
        return view('user.contents.diagnose.results', compact('data'));
    }
}
