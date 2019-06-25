<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Session;
use Auth;
use Storage;
use Mail;

class NewController extends Controller
{

    public function index(){

        $q = "select DISTINCTROW  a.models_id, a.last_change, a.name, m.coupleacc AS diff, m.Modelname, m.first_login, m.name AS full_name, p.path, m.id from models_status a        
        LEFT JOIN models m ON a.models_id = m.id 
        LEFT JOIN models_picture p ON a.models_id = p.modelid
        INNER JOIN (
            SELECT models_id, MAX(last_change) last_change
            FROM models_status
            GROUP BY models_id
        ) b ON a.models_id = b.models_id AND a.last_change = b.last_change WHERE m.Status = 'Approved' ORDER BY last_change DESC";

        //dd($q);

        $lastModelStatus = DB::connection('mysql2')->select($q);


        $totalFree = 0;
        $totalPrivate = 0;
        foreach ($lastModelStatus AS $item) {

            if (isset($item->full_name)){

                if($item->first_login !== 'No Data') {
                    $date = $item->first_login;
                    $datework = Carbon::parse($date)->format('Y-m-d');

                    $now = Carbon::now();
                    $diff = $now->diffInDays($datework);
                    $item->diff = $diff;
                    if($diff <30) $item->first_login = 1;

                }

                switch ($item->name) {
                    case 'private_chat':
                        $totalPrivate++;
                        break;
                    case 'free_chat':
                        $totalFree++;
                        break;
                }
            }
        }

        $totalEverRecorded = $totalPrivate + $totalFree;


        $totalModels = DB::connection('mysql2')->select('SELECT count(id) as total from models')[0]->total;

        $p_online = round($totalEverRecorded*100/$totalModels).'%';
        $p_free = round($totalFree*100/$totalEverRecorded).'%';
        $p_private = round($totalPrivate*100/$totalEverRecorded).'%';

        $jslastModelStatus = json_encode($lastModelStatus);

        return view('new.main', compact('totalModels', 'totalEverRecorded', 'totalFree', 'totalPrivate', 'lastModelStatus', 'visitors', 'forStudio', 'p_online', 'p_free', 'p_private','jslastModelStatus'));

    }

    public function home2(){

        $q = "select DISTINCTROW  a.models_id, a.last_change, a.name, m.coupleacc AS diff, m.Modelname, m.first_login, m.name AS full_name, p.path, m.id from models_status a        
        LEFT JOIN models m ON a.models_id = m.id 
        LEFT JOIN models_picture p ON a.models_id = p.modelid
        INNER JOIN (
            SELECT models_id, MAX(last_change) last_change
            FROM models_status
            GROUP BY models_id
        ) b ON a.models_id = b.models_id AND a.last_change = b.last_change WHERE m.Status = 'Approved' ORDER BY last_change DESC";

        //dd($q);

        $lastModelStatus = DB::connection('mysql2')->select($q);


        $totalFree = 0;
        $totalPrivate = 0;
        foreach ($lastModelStatus AS $item) {

            if (isset($item->full_name)){

                if($item->first_login !== 'No Data') {
                    $date = $item->first_login;
                    $datework = Carbon::parse($date)->format('Y-m-d');

                    $now = Carbon::now();
                    $diff = $now->diffInDays($datework);
                    $item->diff = $diff;
                    if($diff <30) $item->first_login = 1;

                }

                switch ($item->name) {
                    case 'private_chat':
                        $totalPrivate++;
                        break;
                    case 'free_chat':
                        $totalFree++;
                        break;
                }
            }
        }

        $totalEverRecorded = $totalPrivate + $totalFree;


        $totalModels = DB::connection('mysql2')->select('SELECT count(id) as total from models')[0]->total;

        $p_online = round($totalEverRecorded*100/$totalModels).'%';
        $p_free = round($totalFree*100/$totalEverRecorded).'%';
        $p_private = round($totalPrivate*100/$totalEverRecorded).'%';

        $jslastModelStatus = json_encode($lastModelStatus);

        return view('new.main2', compact('totalModels', 'totalEverRecorded', 'totalFree', 'totalPrivate', 'lastModelStatus', 'visitors', 'forStudio', 'p_online', 'p_free', 'p_private','jslastModelStatus'));

    }


    public function othermodels(){

        $result = DB::connection('mysql2')->table('studio_models')->get();

        foreach($result as  $model){
            $model->pic = $this->proxyFetchWStore($model->nickname);
            $model->status = $this->getStatus($model->nickname);
        }

        $result = json_encode($result);

        return compact('result');
    }

    public function getStatus($modelname){

        $cSession = curl_init();
        $url = "http://promo.awempire.com/model_status/index.php?&performerId=".$modelname;
        curl_setopt($cSession, CURLOPT_URL, $url);
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
        $resCurl = curl_exec($cSession);
        curl_close($cSession);
        $status = $resCurl;

        return $status;

    }

    public function modelstest (){

        $allmodels = DB::connection('mysql2')->table('models')->select('Modelname')->where('status', 'Approved')->get();
        //dd($allmodels);

        $mothership = '';
        foreach($allmodels as $model){
            $mothership .= $model->Modelname.',';
        }

        $cSession = curl_init();
        //$url = "http://promo.awempire.com/model_status/index.php?&performerId=AnyaCharming,AdaniaBelle,BrandyArper,AileyBlake,EvaInkz,SilviaEyrie,AmyDelicee,TanyaWelss,AubreyNovaa,IAmKallisa,NadiiaBlack,MoniquePure,JessieRyah,ArianaMistique,RebeccaBlussh,LeylaDuchess,SiaEmerald,DeviousAngell,RaquelleDiva,AmaryGrace,AlexyaFay,AryaWilde,TommyBlame,ErvinBloom,HarleyTricks,VanessaArdor,AmelieSlade,SoniaJayy,MissRixye,Rubyconne,LaraRyse,SophyDavis,LexyRulz,EveliynDiva,SusanBirdy,EllaVonDee,AmeliaReea,TrixieVault,EveVonDee,MadisonDivaa,RanyaDream,NikkySauvage,NatashaVause,AamirDesire,AnaysCharm,BlondViolinn,ArielleFlame,EvaDevine,DamonVeins,AshlleyOwen,AnneDiamondz,EveThompson,GloriaShape,BrandiCharm,ObriDiamond,RaniaAmour,EllaZayra,JasonCrush,SeleneEnn,Anayaa,AishaDevereaux,AmeliaRare,MadeleneRay,YourPreciousMilf,HankBlue,InnocentAdelle,AntonioGiorni,IvyBlueskyy,NaliniBell,HellenRosse,RachellHell,EthanJoy,CaseyHeart,AlessiaRosse,DaphnyMeyer,RebecaGlamy,ArryaVelvet,MeganKroft,AlmmaPure,BrunetteJessica,AnaysMiller,AliaFrenzy,ZairraAsh,AliciaExquisite,HotIsabelleee,SalmaHaze,AlmaRare,RanyaHart,Rebecca000,RinnaBlair,SophieLust,deeana89,TinnaRosen,ArletFall,ElsaKhays,VictoriaRyker,SasshaRed,AmmaFantasy,KiaraHarp,AvenaGold,KataleyaShade,TheaLush,NicolleCheri,ClayreSapphire,SashaLure,AnastasiaKrey,ShellyStaark,IndieDesire,DiamondVicktoria,MyaEden,SingleKaty,AllesiaMaze,KelseyRymes,KathyaTess,DesignerMissy,AmberHaze,AdineDove,AlessiaHazel,AidenHask,AzariahBlu,ZoeMartys,Tiberius,LidiaHarley,ElijahCoxx,AddictiveIrene,modelname,AnfisaCeleste,SonyaBlues,AvrilZarah,MishaBourbons,AvaRavenn,AlennaSwan,GabrielCapitan,DaianaFox,MilenaEden,FreyaLust,AriahDevon,ShadiaGrey,AlessiaChance,ReishaDark,SelynaCarter,AnnabellAzure,SyndraLyon,AshleeDaemon,CayraBanks,RheaVixen,AurianaBloom,LeilaOceans,MayaPicolla,ArikaSilk,LoraineCroft,MadisonRymes,DomVictoriaFay,TatianaSparks,NatashaVonPlay,AlexisCurley,AlexaSophy,KamorraBlack,AnastasiaFeenn,IsabelleShine,LolaMilles,AvaCarter,SanyaBliss,VikyRouge,TiffanyBlayre,AnyaParrish,LoveKimberly,AlegriaSolange,ArminaBlaze,AmelyLure,AayanDancer,BonnieKhane,ThesaRed,SophyFlame,AlexyaSparkle,AubreeCarther,AxelHub,AcselHub,AxelHubs,AdwinGreen,ZhaviaBlossom,TestTest,TestTest,TestTest,AlessiaMaze,ReinaLuxe,ReinaLuxxe,ReinaLuxxxe,MyaDear,AnyssaBayron,InnaStylle,HeatherJammes,CarolleReves,ErinnSin,AniaReign,,,SweetTaniyaa,,,EvoletteAbe,,,DaphneGliss,,,karina%20restrepo,ang%C3%A9lica%20reina,valerie%20gomez,LisaBerniss,,,KarinaWeavey,DeborahFlame,KimberlyMayce,KimberlyMaycee,KimberlyyMaycee,KailiCroft,kailiCroft1,KailiCroft2,AdelyneSanders,NovaLalique,SoniaDown,AimeDiamond,SharonBauller,EsmeeCharm,SylviaRare,SylviaRare,SylviaRare,AlexysJacksson,JasmineNoirr,,,SophyWilde,AlesiaVeiss,AlesiaVeiss,AlesiaVeiss";
        $url = "http://promo.awempire.com/model_status/index.php?&performerId=".$mothership;

        curl_setopt($cSession, CURLOPT_URL, $url);
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
        $resCurl = curl_exec($cSession);
        curl_close($cSession);
        $res = json_decode($resCurl, true);

        $result = array();
        $totalFree = 0;
        $totalPrivate = 0;

        if ( (isset($res['status'])) && ($res['status'] == 'OK')  && ($res['errorCode'] == 0)) {

            $models = $res['data']['models'];
            foreach($models as $key => $value){
                if (($value == 'free_chat') ||($value == 'private_chat')){
                    $res = DB::connection('mysql2')->table('models')->select('id', 'first_login')->where('Modelname', $key)->first();

                    $now = Carbon::now();
                    $today = Carbon::now('Europe/Bucharest')->format('M d Y H:i');
                    if($res->first_login !== 'No Data') {
                        $date = $res->first_login;
                        $datework = Carbon::parse($date)->format('Y-m-d');
                        $diff = $now->diffInDays($datework);
                    } else $diff = 1;

                    switch ($value) {
                        case 'private_chat':
                            $totalPrivate++;
                            break;
                        case 'free_chat':
                            $totalFree++;
                            break;
                    }

                    $path = DB::connection('mysql2')->table('models_picture')->select('path')->where('modelid', $res->id)->first();
                    if ($path == null) $path = '/images/logo100.png'; else $path = $path->path;
                    array_push($result,['name' => $key, 'chat' => $value, 'id' => $res->id, 'path' => $path, 'diff' => $diff, 'data' => $today]);
                }
            }

        } else {
            // error , do smthing
        }

        //dd($result);
        $totalEverRecorded = $totalPrivate + $totalFree;
        $totalModels = DB::connection('mysql2')->select('SELECT count(id) as total from models')[0]->total;
        $p_online = round($totalEverRecorded*100/$totalModels).'%';
        $p_free = round($totalFree*100/$totalEverRecorded).'%';
        $p_private = round($totalPrivate*100/$totalEverRecorded).'%';
        $jslastModelStatus = json_encode($result);


        return view('new.main2', compact('result', 'totalModels', 'totalFree', 'totalPrivate', 'p_online', 'p_free', 'p_private','totalEverRecorded', 'jslastModelStatus'));
    }

    public function ajaxCron(){

        $lastModelStatus = DB::connection('mysql2')->select('select DISTINCTROW  a.models_id, a.last_change, a.name, m.coupleacc AS diff, m.Modelname, m.first_login, m.name AS full_name, p.path, m.id from models_status a        
        LEFT JOIN models m ON a.models_id = m.id 
        LEFT JOIN models_picture p ON a.models_id = p.modelid
        INNER JOIN (
            SELECT models_id, MAX(last_change) last_change
            FROM models_status
            GROUP BY models_id
        ) b ON a.models_id = b.models_id AND a.last_change = b.last_change WHERE m.Status = \'Approved\' ORDER BY last_change DESC');


        $totalFree = 0;
        $totalPrivate = 0;
        foreach ($lastModelStatus AS $item) {

            if (isset($item->full_name)){

                if($item->first_login !== 'No Data') {
                    $date = $item->first_login;
                    $datework = Carbon::parse($date)->format('Y-m-d');
                    $now = Carbon::now();
                    $diff = $now->diffInDays($datework);
                    $item->diff = $diff;
                    if($diff <30) $item->first_login = 1;
                }

                switch ($item->name) {
                    case 'private_chat':
                        $totalPrivate++;
                        break;
                    case 'free_chat':
                        $totalFree++;
                        break;
                }
            } else {
                //dd('here');
            }
        }

        $totalEverRecorded = $totalPrivate + $totalFree;

        $totalModels = DB::connection('mysql2')->select('SELECT count(id) as total from models')[0]->total;

        $p_online = round($totalEverRecorded*100/$totalModels).'%';
        $p_free = round($totalFree*100/$totalEverRecorded).'%';
        $p_private = round($totalPrivate*100/$totalEverRecorded).'%';

        $jslastModelStatus = json_encode($lastModelStatus);

        //return view('new.main', );
        return compact('totalModels', 'totalEverRecorded', 'totalFree', 'totalPrivate', 'lastModelStatus', 'visitors', 'forStudio', 'p_online', 'p_free', 'p_private','jslastModelStatus');
    }


    public function proxyFetch($modelname){

        $cSession = curl_init();
        $url = "http://pt.ptawe.com/api/model/feed?siteId=gjasmin&psId=14noiembrie&psTool=213_1&psProgram=revs&campaignId=&category=girl&limit=10&imageSizes=320x180&imageType=glamour&showOffline=1&extendedDetails=1&responseFormat=json&performerId=".$modelname."&subAffId={SUBAFFID}&accessKey=ea0f7bf083974543186e2abb1f8ac09c&legacyRedirect=1";

        curl_setopt($cSession, CURLOPT_URL, $url);
        curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer 8c23e7366a3e7096a30914edb145efc95fe241cd5be682a5ec1a366ca01e6c70"));
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
        $resCurl = curl_exec($cSession);
        curl_close($cSession);
        $res = json_decode($resCurl, true);

        $pic = 0;

        if ($res['data']['models']){

            $model = $res['data']['models'];
            $picUrl = $model[0]['profilePictureUrl'];

            foreach ($picUrl as $key => $value){
                $pic = $value;
                $rowid = DB::connection('mysql2')->table('models')->where('Modelname', $modelname)->first();
                if($rowid !== null){
                    $existUser = DB::connection('mysql2')->table('models_picture')->where('modelid', $rowid->id)->first();
                    if($existUser == null){
                        DB::connection('mysql2')->table('models_picture')->insert(['modelid' => $rowid->id, 'path' => $pic]);
                    }
                }
            }

        }



        return $pic;


    }

    public function testimg(){


        return view('tinymc');
    }


    public function getModelsFromApi(){


        $cSession = curl_init();
        $url = "https://api.studio20.group/api/gethits";
        //$url = "http://temp.dev-20.ro/gethits";

        curl_setopt($cSession, CURLOPT_URL, $url);
        curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjIzZmE4NWJhODJmZDhjNzBiOWZlMDhiMmI5MDRkNDJjZDBjYjM4Zjg3OTlhYzZkNjM3OGM4YTcyY2I0YjQ5N2RhYThmMTllZjUxYjVlYjhkIn0.eyJhdWQiOiIzIiwianRpIjoiMjNmYTg1YmE4MmZkOGM3MGI5ZmUwOGIyYjkwNGQ0MmNkMGNiMzhmODc5OWFjNmQ2Mzc4YzhhNzJjYjRiNDk3ZGFhOGYxOWVmNTFiNWViOGQiLCJpYXQiOjE1NDkzNzI1OTIsIm5iZiI6MTU0OTM3MjU5MiwiZXhwIjoxNTgwOTA4NTkyLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.EPY6bLbYwoPrtwKjChlsZqcEQPcarrcttaGziTaOvt5didcsWE25tQOH4k_7DKqVUgzyRLFDjHqQqrVstAX2fTusKhjZ-_N2-1SPh3rhVLEHS1WEBAF59FVdar-RGFPPsrmXm7cZDwpUjJWmXcwbr58HGnuIKVEuxpch4HhLACTuSwfTOXByrvqmywykhsUlRWM_-rGCo7zd5B0Y-GkmpPAg5eMplAdc78dmVEtaDoKktS6QjyphuZDkqmoxWVAPFJgi5bl5CiheQqYzXwLhSXRUWLx2g-aiDmuu5bU5NYxNdaqzF_E9iIm_DrAc_ey098CeE4nqwJdIHD8ygkeSlsde1U8PrHXf9598zVckch5ZyGNXKVUMUcpTz8Ic5PXuo9fXEvLO5qdU5CkxhCEzLVLew8iTkDq4SB-iqjLoj3bDz6k74EX_9-N0w9IIDdVcwQnw5mbAMGEWQnudJp5ytuKCeL5BTrqJd1gcDcP5URsku7lUUY6AyNfGIRc81dWRg7AMROCULQZM46crhcYGVer_Lce6wtVYQRL4SwXxDvl_Otm5QN42LdECzXYLjC36b5wZHm9EM8Xc4xKZef14mgtrb4qIs1Lanvdg21RBgUQ0ArPLflBQx4DzUCkCTMS7JbEA09miWXKs3pyAfXtRfMnXs2JEIKN2bAxixbc1AW4"));
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
        $resCurl = curl_exec($cSession);
        curl_close($cSession);
        $res = json_decode($resCurl, true);

        if($res['success'] == true){

            return $res['data'];
        }

        else return null;

    }

    public function getModelsFromApi2(){

        $cSession = curl_init();
        $url = "https://api.studio20.group/api/gethits2";
        curl_setopt($cSession, CURLOPT_URL, $url);
        curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjIzZmE4NWJhODJmZDhjNzBiOWZlMDhiMmI5MDRkNDJjZDBjYjM4Zjg3OTlhYzZkNjM3OGM4YTcyY2I0YjQ5N2RhYThmMTllZjUxYjVlYjhkIn0.eyJhdWQiOiIzIiwianRpIjoiMjNmYTg1YmE4MmZkOGM3MGI5ZmUwOGIyYjkwNGQ0MmNkMGNiMzhmODc5OWFjNmQ2Mzc4YzhhNzJjYjRiNDk3ZGFhOGYxOWVmNTFiNWViOGQiLCJpYXQiOjE1NDkzNzI1OTIsIm5iZiI6MTU0OTM3MjU5MiwiZXhwIjoxNTgwOTA4NTkyLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.EPY6bLbYwoPrtwKjChlsZqcEQPcarrcttaGziTaOvt5didcsWE25tQOH4k_7DKqVUgzyRLFDjHqQqrVstAX2fTusKhjZ-_N2-1SPh3rhVLEHS1WEBAF59FVdar-RGFPPsrmXm7cZDwpUjJWmXcwbr58HGnuIKVEuxpch4HhLACTuSwfTOXByrvqmywykhsUlRWM_-rGCo7zd5B0Y-GkmpPAg5eMplAdc78dmVEtaDoKktS6QjyphuZDkqmoxWVAPFJgi5bl5CiheQqYzXwLhSXRUWLx2g-aiDmuu5bU5NYxNdaqzF_E9iIm_DrAc_ey098CeE4nqwJdIHD8ygkeSlsde1U8PrHXf9598zVckch5ZyGNXKVUMUcpTz8Ic5PXuo9fXEvLO5qdU5CkxhCEzLVLew8iTkDq4SB-iqjLoj3bDz6k74EX_9-N0w9IIDdVcwQnw5mbAMGEWQnudJp5ytuKCeL5BTrqJd1gcDcP5URsku7lUUY6AyNfGIRc81dWRg7AMROCULQZM46crhcYGVer_Lce6wtVYQRL4SwXxDvl_Otm5QN42LdECzXYLjC36b5wZHm9EM8Xc4xKZef14mgtrb4qIs1Lanvdg21RBgUQ0ArPLflBQx4DzUCkCTMS7JbEA09miWXKs3pyAfXtRfMnXs2JEIKN2bAxixbc1AW4"));
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
        $resCurl = curl_exec($cSession);
        curl_close($cSession);
        $res = json_decode($resCurl, true);

        if($res['success'] == true){

            return $res['data'];
        }

        else return null;

    }

    public function getModelsFromApiNewModels(){

        $cSession = curl_init();
        $url = "https://api.studio20.group/api/gethitsnew";
        //$url = "http://temp.dev-20.ro/gethitsnew";

        curl_setopt($cSession, CURLOPT_URL, $url);
        curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjIzZmE4NWJhODJmZDhjNzBiOWZlMDhiMmI5MDRkNDJjZDBjYjM4Zjg3OTlhYzZkNjM3OGM4YTcyY2I0YjQ5N2RhYThmMTllZjUxYjVlYjhkIn0.eyJhdWQiOiIzIiwianRpIjoiMjNmYTg1YmE4MmZkOGM3MGI5ZmUwOGIyYjkwNGQ0MmNkMGNiMzhmODc5OWFjNmQ2Mzc4YzhhNzJjYjRiNDk3ZGFhOGYxOWVmNTFiNWViOGQiLCJpYXQiOjE1NDkzNzI1OTIsIm5iZiI6MTU0OTM3MjU5MiwiZXhwIjoxNTgwOTA4NTkyLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.EPY6bLbYwoPrtwKjChlsZqcEQPcarrcttaGziTaOvt5didcsWE25tQOH4k_7DKqVUgzyRLFDjHqQqrVstAX2fTusKhjZ-_N2-1SPh3rhVLEHS1WEBAF59FVdar-RGFPPsrmXm7cZDwpUjJWmXcwbr58HGnuIKVEuxpch4HhLACTuSwfTOXByrvqmywykhsUlRWM_-rGCo7zd5B0Y-GkmpPAg5eMplAdc78dmVEtaDoKktS6QjyphuZDkqmoxWVAPFJgi5bl5CiheQqYzXwLhSXRUWLx2g-aiDmuu5bU5NYxNdaqzF_E9iIm_DrAc_ey098CeE4nqwJdIHD8ygkeSlsde1U8PrHXf9598zVckch5ZyGNXKVUMUcpTz8Ic5PXuo9fXEvLO5qdU5CkxhCEzLVLew8iTkDq4SB-iqjLoj3bDz6k74EX_9-N0w9IIDdVcwQnw5mbAMGEWQnudJp5ytuKCeL5BTrqJd1gcDcP5URsku7lUUY6AyNfGIRc81dWRg7AMROCULQZM46crhcYGVer_Lce6wtVYQRL4SwXxDvl_Otm5QN42LdECzXYLjC36b5wZHm9EM8Xc4xKZef14mgtrb4qIs1Lanvdg21RBgUQ0ArPLflBQx4DzUCkCTMS7JbEA09miWXKs3pyAfXtRfMnXs2JEIKN2bAxixbc1AW4"));
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
        $resCurl = curl_exec($cSession);
        curl_close($cSession);
        $res = json_decode($resCurl, true);

        if($res['success'] == true){

            return $res['data'];
        }

        else return null;

    }

    public function getModelsFromApiNewModels2(){

        $cSession = curl_init();
        $url = "https://api.studio20.group/api/gethitsnew2";
        //$url = "http://temp.dev-20.ro/gethitsnew";

        curl_setopt($cSession, CURLOPT_URL, $url);
        curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjIzZmE4NWJhODJmZDhjNzBiOWZlMDhiMmI5MDRkNDJjZDBjYjM4Zjg3OTlhYzZkNjM3OGM4YTcyY2I0YjQ5N2RhYThmMTllZjUxYjVlYjhkIn0.eyJhdWQiOiIzIiwianRpIjoiMjNmYTg1YmE4MmZkOGM3MGI5ZmUwOGIyYjkwNGQ0MmNkMGNiMzhmODc5OWFjNmQ2Mzc4YzhhNzJjYjRiNDk3ZGFhOGYxOWVmNTFiNWViOGQiLCJpYXQiOjE1NDkzNzI1OTIsIm5iZiI6MTU0OTM3MjU5MiwiZXhwIjoxNTgwOTA4NTkyLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.EPY6bLbYwoPrtwKjChlsZqcEQPcarrcttaGziTaOvt5didcsWE25tQOH4k_7DKqVUgzyRLFDjHqQqrVstAX2fTusKhjZ-_N2-1SPh3rhVLEHS1WEBAF59FVdar-RGFPPsrmXm7cZDwpUjJWmXcwbr58HGnuIKVEuxpch4HhLACTuSwfTOXByrvqmywykhsUlRWM_-rGCo7zd5B0Y-GkmpPAg5eMplAdc78dmVEtaDoKktS6QjyphuZDkqmoxWVAPFJgi5bl5CiheQqYzXwLhSXRUWLx2g-aiDmuu5bU5NYxNdaqzF_E9iIm_DrAc_ey098CeE4nqwJdIHD8ygkeSlsde1U8PrHXf9598zVckch5ZyGNXKVUMUcpTz8Ic5PXuo9fXEvLO5qdU5CkxhCEzLVLew8iTkDq4SB-iqjLoj3bDz6k74EX_9-N0w9IIDdVcwQnw5mbAMGEWQnudJp5ytuKCeL5BTrqJd1gcDcP5URsku7lUUY6AyNfGIRc81dWRg7AMROCULQZM46crhcYGVer_Lce6wtVYQRL4SwXxDvl_Otm5QN42LdECzXYLjC36b5wZHm9EM8Xc4xKZef14mgtrb4qIs1Lanvdg21RBgUQ0ArPLflBQx4DzUCkCTMS7JbEA09miWXKs3pyAfXtRfMnXs2JEIKN2bAxixbc1AW4"));
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
        $resCurl = curl_exec($cSession);
        curl_close($cSession);
        $res = json_decode($resCurl, true);


        if($res['success'] == true){

            return $res['data'];
        }

        else return null;

    }

    public function proxyFetchWStore($modelname){

        $cSession = curl_init();
        $url = "http://pt.ptawe.com/api/model/feed?siteId=gjasmin&psId=14noiembrie&psTool=213_1&psProgram=revs&campaignId=&category=girl&limit=10&imageSizes=320x180&imageType=glamour&showOffline=1&extendedDetails=1&responseFormat=json&performerId=".$modelname."&subAffId={SUBAFFID}&accessKey=ea0f7bf083974543186e2abb1f8ac09c&legacyRedirect=1";

        curl_setopt($cSession, CURLOPT_URL, $url);
        curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer 8c23e7366a3e7096a30914edb145efc95fe241cd5be682a5ec1a366ca01e6c70"));
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
        $resCurl = curl_exec($cSession);
        curl_close($cSession);
        $res = json_decode($resCurl, true);

        $pic = '/images/logo100.png';

        if ($res['data']['models']){

            $model = $res['data']['models'];
            $picUrl = $model[0]['profilePictureUrl'];

            foreach ($picUrl as $key => $value){
                $pic = $value;
            }

        }



        return $pic;


    }

    public function getDays($modelname){

        //get id
        $first_login = DB::connection('mysql2')->table('models')->select('first_login')->where('Modelname', $modelname)->pluck('first_login')->first();
        $diff = 31;
        if($first_login){
            if($first_login !== 'No Data') {
                $date = $first_login;
                $datework = Carbon::parse($date)->format('Y-m-d');
                $now = Carbon::now();
                $diff = $now->diffInDays($datework);

            }
        }

        return $diff;

    }

    public function home3(){

        $resultModels = DB::connection('mysql2')->table('models')->select('Modelname')->where('status', 'Approved')->pluck('Modelname')->toArray();
        $resultOtherModels = DB::connection('mysql2')->table('studio_models')->select('nickname')->pluck('nickname')->toArray();

        $merge = array_merge($resultModels, $resultOtherModels);
        $resultModels = json_encode($merge);


        return view('new.main3', compact('resultModels'));
    }

    public function home3ajax(){

        $resultModels = DB::connection('mysql2')->table('models')->select('Modelname')->where('status', 'Approved')->pluck('Modelname')->toArray();
        //$resultOtherModels = DB::connection('mysql2')->table('studio_models')->select('nickname')->pluck('nickname')->toArray();

        //$merge = array_merge($resultModels, $resultOtherModels);

        //return $merge;
        return $resultModels;
    }

    public function ajax3 (){


        $models = $this->home3ajax();
        $sizeallmodelsapprovedother = count($models);

        $resultModels = json_encode($this->getAjaxData($models));

        return view('new.main3', compact('resultModels','sizeallmodelsapprovedother'));


    }

    public function ajax4 (){


        $models = $this->getModelsFromApi();
        $sizeallmodelsapprovedother = count($models);

        $resultModels = json_encode($models);

        return view('new.main4', compact('resultModels','sizeallmodelsapprovedother'));


    }

    public function ajax5 (){


        $models = $this->getModelsFromApi2();

        $sizeallmodelsapprovedother = count($models);

        $resultModels = json_encode($models);

        return view('new.main5', compact('resultModels','sizeallmodelsapprovedother'));


    }

    public function ajax6 (){

        $models = $this->getModelsFromApi2();

        $sizeallmodelsapprovedother = count($models);

        $resultModels = json_encode($models);

        //dd($resultModels);

        return view('new.main6', compact('resultModels','sizeallmodelsapprovedother'));


    }

    public function ajaxBan(Request $request){

        $ip = $request->input("ip");
        $ip_ban = 'error';

        $ip_ban_res = DB::connection('mysql5')->table('analytics_ip_ban')->where('ip',$ip)->first();
        if($ip_ban_res){
            $ip_ban = $ip_ban_res->ban;
            if ($ip_ban == 1) {
                DB::connection('mysql5')->table('analytics_ip_ban')->where('id',$ip_ban_res->id)->update(['ban' => 0]);
                $ip_ban = 'status now: NO-BAN';
            } else {
                DB::connection('mysql5')->table('analytics_ip_ban')->where('id',$ip_ban_res->id)->update(['ban' => 1]);
                $ip_ban = 'status now: BAN';
            }
        } else {
            //insert ip to ban
            DB::connection('mysql5')->table('analytics_ip_ban')->insert(['ip' => $ip, 'ban' => 1]);
            $ip_ban = 'inserted';
        }

        return $ip_ban;

    }

    public function newmodels(){

        $models = $this->getModelsFromApiNewModels();
        $sizeallmodelsapprovedother = count($models);

        $resultModels = json_encode($models);

        return view('new.newmodels', compact('resultModels','sizeallmodelsapprovedother'));

    }

    public function newmodels2(){

        $models = $this->getModelsFromApiNewModels2();
        if ($models) $sizeallmodelsapprovedother = count($models);
        else $sizeallmodelsapprovedother = 0;

        $resultModels = json_encode($models);


        return view('new.newmodels2', compact('resultModels','sizeallmodelsapprovedother'));

    }

    public function task(){


        $res = DB::table('trafic')->whereNull('date')->get();

        foreach ($res as $model){
            $old = $model->old_Date;
            $old = substr($old, 0, 10);
            $old = explode('-', $old);
            $old = $old[2].'-'.$old[1].'-'.$old[0];

            DB::table('trafic')->where('id', $model->id)->update(['date' => $old]);

        }

    }

    public function cronjob(){

        $resStudio20cam = DB::connection('mysql4')->table('trafic')->get();

        foreach ($resStudio20cam as $model){

            $old = $model->Date;
            $old = substr($old, 0, 10);
            $old = explode('-', $old);
            $old = $old[2].'-'.$old[1].'-'.$old[0];

            DB::table('trafic')->insert(['modelname' => $model->Model, 'ip' => $model->Ip, 'old_Date' => $model->Date, 'date' => $old,'source' => $model->Source, 'medium' => $model->Medium, 'campaign' => $model->Campaign]);
        }

        DB::connection('mysql4')->table('trafic')->truncate();



    }

    public function lastTenDays($modelname){

        $days = array();
        $periods = array();

        for($i = 1; $i<11; $i++){
            $day = Carbon::today('Europe/Bucharest')->subDays($i)->format('Y-m-d');
            $daysHours = $this->getHoursJasmin($modelname,$day, $day);
            $daysMoney = $this->getMoneyJasmin($modelname,$day, $day);
            $days[$day] = [$daysHours,number_format((float)$daysMoney, 2, '.', '')];
        }

        return ($days);

    }


    public function lastFivePeriods($model){

        $periodss = array();

        $modelrow = DB::connection('mysql2')->table('models')->where('Modelname',$model)->first();

        if(($modelrow !== null) && (isset($modelrow->id))) {

            $periods = DB::connection('mysql2')
                ->table('periods')
                ->select('period','hours','totalamount')
                ->where('modelid',$modelrow->id)
                ->orderBy('buttondate','DESC')
                ->limit(5)
                ->get();

            foreach($periods as $per){
                $periodss[$per->period] = [$per->hours,number_format((float)$per->totalamount, 2, '.', '')];
            }

        }


        return ($periodss);
    }

    function getMoneyJasmin($modelname, $datestart, $dateEnd) {

        $authorization = "Authorization: Bearer 406ad45b5ed5748abb871cc99ef69bc45d0ad2779f9034f91de5af254f8a9902";
        $authorization1 = "Authorization: Bearer 8c23e7366a3e7096a30914edb145efc95fe241cd5be682a5ec1a366ca01e6c70";
        $url = "https://partner-api.modelcenter.jasmin.com/v1/statistics/income/performers/$modelname?fromDate=$datestart&toDate=$dateEnd";

        $res = $this->curlAuth($authorization, $url);
        if (!array_key_exists('errorMessage', $res)){

        } else $res = $this->curlAuth($authorization1, $url);


        if (!array_key_exists('errorMessage', $res)){
            $private = $res["private"];
            $vipshow = $res["vipShow"];
            $scheduled = $res["scheduledShow"];
            $videoVoiceCall = $res["videoVoiceCall"];
            $groupPrivate = $res["groupPrivate"];
            $surprise = $res["surprise"];
            $sneakpeek = $res["sneakPeek"];
            $snapshot = $res["snapshot"];
            $mycontent = $res["myContent"];
            $fanclub = $res["fanClub"];
            $channel = $res["channel"];
            $vod = $res["vod"];
            $messaging = $res["messaging"];
            $awards = $res["awards"];
            $referral = $res["referral"];
            $tipmodels = $res["tipmodels"];
            $miscellaneous = $res["miscellaneous"];
            $myStory = $res["myStory"];

            if (strpos($miscellaneous, '-') !== false) {
                $miscellaneous = str_replace('-', '', $miscellaneous);
                $total = $private + $vipshow + $scheduled + $groupPrivate + $surprise + $sneakpeek + $snapshot + $mycontent + $fanclub + $channel + $vod + $messaging + $referral + $awards + $tipmodels + $videoVoiceCall + $myStory;
                $total = $total - $miscellaneous;
            } else {
                $total = $private + $vipshow + $scheduled + $groupPrivate + $surprise + $sneakpeek + $snapshot + $mycontent + $fanclub + $channel + $vod + $messaging + $referral + $awards + $tipmodels + $miscellaneous + $videoVoiceCall + $myStory;
            }

            return $total;

        } else {
            return 0;
        }

    }

    function getHoursJasmin($modelname, $startdate, $enddate) {

        $authorization = "Authorization: Bearer 406ad45b5ed5748abb871cc99ef69bc45d0ad2779f9034f91de5af254f8a9902";
        $authorization1 = "Authorization: Bearer 8c23e7366a3e7096a30914edb145efc95fe241cd5be682a5ec1a366ca01e6c70";
        $url = "https://partner-api.modelcenter.jasmin.com/v1/statistics/chat-times?fromDate=$startdate&toDate=$enddate&screenNames[]=$modelname";

        $res = $this->curlAuth($authorization, $url);
        if (array_key_exists($modelname, $res)){

        } else $res = $this->curlAuth($authorization1, $url);

        $freechat = 0;
        $memberchat = 0;
        $privatechat = 0;

        if (array_key_exists($modelname, $res)) {


            $model_name = $res[$modelname];
            foreach ($model_name as $key => $value){
                $freechat += $model_name[$key]['freeChatSeconds'];
                $memberchat += $model_name[$key]['memberChatSeconds'];
                $privatechat += $model_name[$key]['privateShowSeconds'];
            }

            $totaltime = $freechat + $privatechat;
            $hours = floor($totaltime / 3600);
            $minutes = floor(($totaltime / 60) % 60);
            if ($minutes <= 9) {
                $minutes = "0$minutes";
            }
            $seconds = $totaltime % 60;
            if ($seconds <= 9) {
                $seconds = "0$seconds";
            }

            $time = "$hours:$minutes:$seconds";

            return $time;

        } else {
            return "0:0:0";
        }


    }

    function curlAuth($auth, $url){

        $authorization = $auth;
        $cSession = curl_init();

        //step2
        curl_setopt($cSession, CURLOPT_URL, $url);
        curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($cSession);
        curl_close($cSession);
        $res = json_decode($result, true);

        return $res;

    }

    public function getModelVisit($model){

        $res = DB::connection('mysql4')->table('smartend_visitors')->where('modelname',$model)->whereDate('created_at', Carbon::today())->first();

        $res = (($res) && isset($res->modelname)) ? $res->hits : 0;

        return $res;
    }

    public function ajaxCron3(){

        $models = $this->home3ajax();
        $sizeallmodelsapprovedother = count($models);

        $resultModels = json_encode($this->getAjaxData($models));

        return compact('resultModels','sizeallmodelsapprovedother');

    }

    public function apimodels(){

        $models = $this->home3ajax();

        $resultModels = json_encode($this->getAjaxDataNoDetails($models));

        return $resultModels;

    }

    public function vasile(){

        return view('new.vasile');
    }

    public function getAjaxData($models){

        $modelStatus = array();
        $modelStatus2 = array();

        $arrchuck = array_chunk($models, 50);

        foreach($arrchuck as $arr){
            $modelstring = '';
            foreach($arr as $ar){
                $modelstring .= $ar.',';
            }

            $cSession = curl_init();
            $url = "http://pt.ptawe.com/api/model/feed?siteId=gjasmin&psId=14noiembrie&psTool=213_1&psProgram=revs&campaignId=&category=girl&limit=10&imageSizes=320x180&imageType=glamour&showOffline=1&extendedDetails=1&responseFormat=json&performerId=".$modelstring."&subAffId={SUBAFFID}&accessKey=ea0f7bf083974543186e2abb1f8ac09c&legacyRedirect=1";
            curl_setopt($cSession, CURLOPT_URL, $url);
            curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
            $resCurl = curl_exec($cSession);
            curl_close($cSession);
            $res = json_decode($resCurl, true);

            if ( (isset($res['status'])) && ($res['status'] == 'OK')  && ($res['errorCode'] == 0)) {

                $modelStatus = $res['data']['models'];
                $modelStatus2 = array_merge($modelStatus,$modelStatus2);
            }

        }
        /*foreach($modelStatus2 as $model){
            $res = DB::connection('mysql4')->table('smartend_analytics_visitors')->where('modelname',$model['performerId'])->whereDate('created_at', Carbon::today())->get();
            $model->visits = (($res !== null) && (isset($res->modelname))) ? count($res) : 0;
            $model->visits = count($res);

        }*/



        return $modelStatus2;

    }

    public function getAjaxDataNoDetails($models){

        $modelStatus2 = array();

        $arrchuck = array_chunk($models, 50);

        foreach($arrchuck as $arr){
            $modelstring = '';
            foreach($arr as $ar){
                $modelstring .= $ar.',';
            }

            $cSession = curl_init();

            //$url = "http://pt.ptawe.com/api/model/feed?siteId=gjasmin&psId=14noiembrie&psTool=213_1&psProgram=revs&campaignId=&category=girl&limit=10showOffline=1&extendedDetails=1&responseFormat=json&performerId=".$modelstring."&subAffId={SUBAFFID}&accessKey=ea0f7bf083974543186e2abb1f8ac09c&legacyRedirect=1";
            $url = "http://pt.ptawe.com/api/model/feed?siteId=gjasmin&psId=14noiembrie&psTool=213_1&psProgram=revs&campaignId=&category=girl&limit=10&imageSizes=320x180&imageType=glamour&showOffline=1&extendedDetails=1&responseFormat=json&performerId=".$modelstring."&subAffId={SUBAFFID}&accessKey=ea0f7bf083974543186e2abb1f8ac09c&legacyRedirect=1";

            curl_setopt($cSession, CURLOPT_URL, $url);
            curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
            $resCurl = curl_exec($cSession);
            curl_close($cSession);
            $res = json_decode($resCurl, true);

            if ( (isset($res['status'])) && ($res['status'] == 'OK')  && ($res['errorCode'] == 0)) {

                $modelStatus = $res['data']['models'];
                $modelStatus2 = array_merge($modelStatus,$modelStatus2);
            }

        }

        return $modelStatus2;

    }
}
