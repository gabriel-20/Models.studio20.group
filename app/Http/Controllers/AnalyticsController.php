<?php

namespace App\Http\Controllers;

use App\AnalyticsPage;
use App\AnalyticsVisitor;
use App\Http\Requests;
use App\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;
use DB;
use Cache;
use Redis;
use Carbon\Carbon;


class AnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
//        if (!@Auth::user()->permissionsGroup->analytics_status) {
//            return Redirect::to(route('NoPermission'))->send();
//        }
    }

    /**
     * Display a listing of the resource.
     * string $stat
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, $stat = "date")
    {


        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $start = $time;

        $analyticsVars = array("date", "country", "city", "os", "browser", "referrer", "hostname", "org","modelname", "source", "medium", "campaign");
        if (!in_array($stat, $analyticsVars)) {
            return redirect()->action('AnalyticsController@index');
        }

        $AnalyticsMin = DB::table('trafic')->min('date');
        $AnalyticsMax = DB::table('trafic')->max('date');




        $daterangepicker_start = date('Y-m-d', strtotime('-29 day'));
        $daterangepicker_end = date('Y-m-d');


        if ($request->session()->has('datepickerstart')) {
            $daterangepicker_start =  $request->session()->get('datepickerstart', $daterangepicker_start);
        }

        if ($request->session()->has('datepickerstart')) {
            $daterangepicker_end =  $request->session()->get('datepickerend', $daterangepicker_end);
        }

        $daterangepicker_start_text = date("F d , Y", strtotime($daterangepicker_start));
        $daterangepicker_end_text = date("F d , Y", strtotime($daterangepicker_end));


        $min_visitor_date = date('d-m-Y', strtotime('-29 day'));
        if ($AnalyticsMin != "") {
            $min_visitor_date = date('d-m-Y', strtotime($AnalyticsMin));
        }
        $max_visitor_date = date('d-m-Y');
        if ($AnalyticsMax != "") {
            $max_visitor_date = date('d-m-Y', strtotime($AnalyticsMax));
        }


        $AnalyticsValues = array();
        //Cache::flush();
        $cachName = 'index_analytics_source_'.$stat."_".$daterangepicker_start."_".$daterangepicker_end;

        $AnalyticsVisitors = Cache::remember($cachName, 30, function () use ($daterangepicker_start, $daterangepicker_end, $stat) {

        return DB::table('trafic')
        ->select($stat, DB::raw('count(*) as total'))
        ->where('date', '>=', $daterangepicker_start)
        ->where('date', '<=', $daterangepicker_end)
        ->groupBy($stat)
        ->orderBy('total', 'desc')
        ->get();

        });

        dd($AnalyticsVisitors);

        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $finish = $time;
        $total_time = round(($finish - $start), 4);
        print_r('Page generated in '.$total_time.' seconds.');


//        $ix = 0;
//        foreach ($AnalyticsVisitors as $AnalyticsV) {
//
//            $asd = $AnalyticsV->$stat;
//
//            $TotalV = Cache::remember('index_analytics_source_total_'.$stat."_".$daterangepicker_start."_".$daterangepicker_end."_".$asd, 30, function () use ($stat, $daterangepicker_start, $daterangepicker_end, $asd) {
//
//                return DB::table('trafic')->where("$stat", $asd)
//                    ->where('date', '>=', $daterangepicker_start)
//                    ->where('date', '<=', $daterangepicker_end)->count();
//
//            });
//
//
//
//            $newdata = array(
//                'name' => $AnalyticsV->$stat,
//                'visits' => $TotalV,
//                'pages' => $TotalV
//            );
//            array_push($AnalyticsValues, $newdata);
//            $ix++;
//        }
//        if ($stat == "date") {
//
//        } else {
//            usort($AnalyticsValues, function ($a, $b) {
//                return $b['visits'] - $a['visits'];
//            });
//        }
//

        $TotalVisitors = Cache::remember('index_analytics_source_total_visitors_'.$daterangepicker_start."_".$daterangepicker_end, 30, function () use ($daterangepicker_start, $daterangepicker_end) {


            return DB::table('trafic')->where('date', '>=', $daterangepicker_start)
                ->where('date', '<=', $daterangepicker_end)
                ->count();
        });
//
//
//
//        $TotalPages = Cache::remember('index_analytics_source_total_pages_'.$daterangepicker_start."_".$daterangepicker_end, 30, function () use ($daterangepicker_start, $daterangepicker_end) {
//
//
//            return DB::table('trafic')->where('date', '>=', $daterangepicker_start)
//                ->where('date', '<=', $daterangepicker_end)
//                ->count();
//        });



        if ($stat == "org") {
            $statText = "visitorsAnalyticsByOrganization";
        } elseif ($stat == "hostname") {
            $statText = "visitorsAnalyticsByHostName";
        } elseif ($stat == "referrer") {
            $statText = "visitorsAnalyticsByReachWay";
        } elseif ($stat == "resolution") {
            $statText = "visitorsAnalyticsByScreenResolution";
        } elseif ($stat == "browser") {
            $statText = "visitorsAnalyticsByBrowser";
        } elseif ($stat == "os") {
            $statText = "visitorsAnalyticsByOperatingSystem";
        } elseif ($stat == "country") {
            $statText = "visitorsAnalyticsByCountry";
        } elseif ($stat == "city") {
            $statText = "visitorsAnalyticsByCity";
        }elseif ($stat == "source") {
            $statText = "visitorsAnalyticsBysource";
        } elseif ($stat == "date") {
            $statText = "visitorsAnalyticsBydate";
        } elseif ($stat == "medium") {
            $statText = "visitorsAnalyticsByMedium";
        } elseif ($stat == "campaign") {
            $statText = "visitorsAnalyticsByCampaign";
        } else {
            $statText = "visitorsAnalyticsBymodel";
        }

        $TotalPages = $TotalVisitors;

        return view("backEnd.analytics",
            compact( "daterangepicker_start", "daterangepicker_end",
                "daterangepicker_start_text", "daterangepicker_end_text", "min_visitor_date", "max_visitor_date",
                "stat", "AnalyticsVisitors", "TotalVisitors", "TotalPages", "statText", "AnalyticsValues"));

    }

    /**
     * Display a listing of the resource.
     * string $stat
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function filter(Request $request, $stat = "date")
    {
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $start = $time;
        //
        // General for all pages
        //$GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END


        //List Min & Max
        //$AnalyticsMin = AnalyticsVisitor::min("date");
        //$AnalyticsMax = AnalyticsVisitor::max("date");

        $AnalyticsMin = DB::table('trafic')->min('date');
        $AnalyticsMax = DB::table('trafic')->max('date');


        $daterangepicker_start = date('Y-m-d', strtotime('-1 day'));
        if ($request->this_daterangepicker_start != "") {

            $request->session()->put('datepickerstart', $request->this_daterangepicker_start);
            $daterangepicker_start = $request->this_daterangepicker_start;

        }

        if ($request->session()->has('datepickerstart')) {
            $daterangepicker_start =  $request->session()->get('datepickerstart', $daterangepicker_start);
        }



        $daterangepicker_end = date('Y-m-d');
        if ($request->this_daterangepicker_end != "") {
            $request->session()->put('datepickerend', $request->this_daterangepicker_end);
            $daterangepicker_end = $request->this_daterangepicker_end;
        }

        if ($request->session()->has('datepickerend')) {
            $daterangepicker_end =  $request->session()->get('datepickerend', $daterangepicker_end);
        }


        $daterangepicker_start_text = date("F d , Y", strtotime($daterangepicker_start));
        //dd($daterangepicker_start_text);
        $daterangepicker_end_text = date("F d , Y", strtotime($daterangepicker_end));
        $min_visitor_date = date('d-m-Y', strtotime('-1 day'));
        if ($AnalyticsMin != "") {
            $min_visitor_date = date('d-m-Y', strtotime($AnalyticsMin));
        }
        $max_visitor_date = date('d-m-Y');
        if ($AnalyticsMax != "") {
            $max_visitor_date = date('d-m-Y', strtotime($AnalyticsMax));
        }


        $AnalyticsValues = array();

       // DB::connection('mysql4')->enableQueryLog();

//        $AnalyticsVisitors = AnalyticsVisitor::where('date', '>=', $daterangepicker_start)
//            ->where('date', '<=', $daterangepicker_end)
//            ->groupBy($stat)
//            ->orderBy($stat, 'asc')
//            ->get();

        //$expiresAt = Carbon::now()->addMinutes(1);
        //Cache::put('key', 'value', $expiresAt);

        $AnalyticsVisitors = Cache::remember('analytics_source_'.$stat."_".$daterangepicker_start."_".$daterangepicker_end, 30, function () use ($daterangepicker_start, $daterangepicker_end, $stat) {

            if ($stat == 'modelname') {
                $daterangepicker_start = date('Y-m-d');
                $daterangepicker_end = date('Y-m-d');
            }

            return DB::table('trafic')->where('date', '>=', $daterangepicker_start)
                ->where('date', '<=', $daterangepicker_end)
                ->groupBy($stat)
                ->orderBy($stat, 'asc')
                ->get();
        });

        //$AnalyticsVisitors = $value;

      //  $log = DB::connection('mysql4')->getQueryLog();

      //  print_r($log);




        $ix = 0;
        foreach ($AnalyticsVisitors as $AnalyticsV) {
            $asd = $AnalyticsV->$stat;

            $TotalV = Cache::remember('analytics_source_total_'.$stat."_".$daterangepicker_start."_".$daterangepicker_end."_".$asd, 30, function () use ($stat, $daterangepicker_start, $daterangepicker_end, $asd) {
            return DB::table('trafic')->where("$stat", $asd)
                ->where('date', '>=', $daterangepicker_start)
                ->where('date', '<=', $daterangepicker_end)->count();
        });


//            $TotalV = AnalyticsVisitor::where("$stat", $AnalyticsV->$stat)
//                ->where('date', '>=', $daterangepicker_start)
//                ->where('date', '<=', $daterangepicker_end)->count();

//            $AllVArray = AnalyticsVisitor::select('id')->where("$stat", $AnalyticsV->$stat)
//                ->where('date', '>=', $daterangepicker_start)
//                ->where('date', '<=', $daterangepicker_end)
//                ->get()
//                ->toArray();
//
//            $TotalP = AnalyticsPage::whereIn("visitor_id", $AllVArray)->count();



            $newdata = array(
                'name' => $AnalyticsV->$stat,
                'visits' => $TotalV,
                'pages' => $TotalV
            );
            array_push($AnalyticsValues, $newdata);
            $ix++;
        }

        if ($stat == "date") {

        } else {
            usort($AnalyticsValues, function ($a, $b) {
                return $b['visits'] - $a['visits'];
            });
        }

        $TotalVisitors = Cache::remember('analytics_source_total_visitors_'.$daterangepicker_start."_".$daterangepicker_end, 30, function () use ($daterangepicker_start, $daterangepicker_end) {
            return DB::table('trafic')->where('date', '>=', $daterangepicker_start)
                ->where('date', '<=', $daterangepicker_end)
                ->count();
        });


        $TotalPages = Cache::remember('analytics_source_total_pages_'.$daterangepicker_start."_".$daterangepicker_end, 30, function () use ($daterangepicker_start, $daterangepicker_end) {
            return DB::table('trafic')->where('date', '>=', $daterangepicker_start)
                ->where('date', '<=', $daterangepicker_end)
                ->count();
        });

//        $TotalVisitors = AnalyticsVisitor::where('date', '>=', $daterangepicker_start)
//            ->where('date', '<=', $daterangepicker_end)
//            ->count();
//
//        $TotalPages = AnalyticsPage::where('date', '>=', $daterangepicker_start)
//            ->where('date', '<=', $daterangepicker_end)
//            ->count();

        if ($stat == "org") {
            $statText = "visitorsAnalyticsByOrganization";
        } elseif ($stat == "hostname") {
            $statText = "visitorsAnalyticsByHostName";
        } elseif ($stat == "referrer") {
            $statText = "visitorsAnalyticsByReachWay";
        } elseif ($stat == "resolution") {
            $statText = "visitorsAnalyticsByScreenResolution";
        } elseif ($stat == "browser") {
            $statText = "visitorsAnalyticsByBrowser";
        } elseif ($stat == "os") {
            $statText = "visitorsAnalyticsByOperatingSystem";
        } elseif ($stat == "country") {
            $statText = "visitorsAnalyticsByCountry";
        } elseif ($stat == "city") {
            $statText = "visitorsAnalyticsByCity";
        } elseif ($stat == "date") {
            $statText = "visitorsAnalyticsBydate";
        } else {
            $statText = "visitorsAnalyticsBymodel";
        }

        //$this->mydd($AnalyticsValues);

        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $finish = $time;
        $total_time = round(($finish - $start), 4);
        print_r('Page generated in '.$total_time.' seconds.');

        return view("backEnd.analytics",
            compact( "daterangepicker_start", "daterangepicker_end",
                "daterangepicker_start_text", "daterangepicker_end_text", "min_visitor_date", "max_visitor_date",
                "stat", "AnalyticsVisitors", "TotalVisitors", "TotalPages", "statText", "AnalyticsValues"));

    }

    function visitorsbysource(Request $request, $range){

        $range = "-" . $range . " day";

        $min_visitor_date = date('Y-m-d', strtotime($range));

        $date = date('Y-m-d');

        $AnalyticsVisitors = DB::connection('mysql4')
            ->table('analytics_visitors')
            //->select('source','created_at')
            ->select('source', DB::raw('count(*) as total, created_at'))
            ->groupBy('source')
            ->where('created_at','>',$min_visitor_date)
            ->get();

        return view("backEnd.visitorsbysource", compact( "AnalyticsVisitors","date"));
    }



    function mydd($var)
    {
        if ($this->get_client_ip() == '188.214.255.240'){
            dd($var);
        } else {
            //dd('non-ip');
        }

    }

    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function visitors()
    {
        //
        // General for all pages
        // $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List of Analytics Visitors
        $AnalyticsVisitors = AnalyticsVisitor::orderby('date', 'desc')->orderby('time',
            'desc')->paginate(env('BACKEND_PAGINATION'));

        return view("backEnd.visitors", compact( "AnalyticsVisitors"));
    }

    /**
     * Display a listing of the resource.
     * string $ip_code
     * @return \Illuminate\Http\Response
     */

    public function visitorsByIp(){

        $date = date('Y-m-d');

        //List of Analytics Visitors by Ip
        // $AnalyticsVisitors = AnalyticsVisitor::orderby('date', 'desc')->where('date',$date)->orderby('time','desc')->get();

//        $AnalyticsVisitors = DB::connection('mysql5')
//            ->table('analytics_visitors')
//            ->select('analytics_visitors.date','analytics_visitors.time','analytics_visitors.ip','analytics_visitors.city','analytics_visitors.country_code','analytics_visitors.country','analytics_visitors.count','analytics_ip_ban.ban')
//            ->leftJoin('analytics_ip_ban', 'analytics_visitors.ip', '=', 'analytics_ip_ban.ip')
//            ->orderby('analytics_visitors.date', 'desc')
//            ->where('analytics_visitors.date',$date)
//            ->orderby('analytics_visitors.time','desc')->get();

        $AnalyticsVisitors = DB::table('trafic')->orderby('date', 'desc')->where('date', $date)->get();

        return view("backEnd.visitorsbyip", compact( "AnalyticsVisitors","date"));

    }

    public function visitorsBanner(){

        $date = date('Y-m-d');

        //List of Analytics Visitors by Ip
        // $AnalyticsVisitors = AnalyticsVisitor::orderby('date', 'desc')->where('date',$date)->orderby('time','desc')->get();

        $AnalyticsVisitors = DB::connection('mysql6')
            ->table('banner')
            ->select(DB::raw('count(day(time)) as total, time'))
            //->groupBy('Day')
            ->get();

        //dd($AnalyticsVisitors);

        return view("backEnd.visitorsbanner", compact( "AnalyticsVisitors","date"));

    }


    public function ip($ip_code = null)
    {
        // General for all pages
        // $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List of Analytics Visitors
        if ($ip_code != "") {
            $AnalyticsVisitors = AnalyticsVisitor::where('ip', $ip_code)
                ->orderby('id', 'desc')->get();
        } else {
            $AnalyticsVisitors = "";
        }

        return view("backEnd.ip", compact( "AnalyticsVisitors", "ip_code"));
    }

    /**
     * Search resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function search(
        Request $request
    ) {
        //
        // General for all pages
        // $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if ($request->ip != "") {
            $AnalyticsVisitors = AnalyticsVisitor::where('ip', $request->ip)
                ->orderby('id', 'desc')->get();
        } else {
            $AnalyticsVisitors = "";
        }

        $ip_code = $request->ip;

        return view("backEnd.ip", compact("GeneralWebmasterSections", "AnalyticsVisitors", "ip_code"));
    }


}
