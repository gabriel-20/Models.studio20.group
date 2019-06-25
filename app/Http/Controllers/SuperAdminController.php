<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SuperAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function trafficstats()
    {
        $hits = DB::connection('mysql3')->table('models')->get();

        return view('new.traficstats', compact('hits'));
    }

    public function twitterstats()
    {

        $tweets = DB::connection('mysql2')->table('models_tweets')->get();


        return view('new.twitterstats', compact('tweets'));
    }

    public function twitterstats2()
    {


        $promo = DB::connection('mysql2')
            ->table('twitter_promo')
            ->select('account')
            ->pluck('account')->toArray();

        $tweets = DB::connection('mysql2')->table('models_tweets')->whereNotIn('twitter_account', $promo)->get();

        $tweetsPromo = DB::connection('mysql2')
            ->table('twitter_promo')
            ->leftJoin('models_tweets','twitter_promo.account','=','models_tweets.twitter_account')
            ->get();

        return view('new.twitterstats2', compact('tweets','tweetsPromo'));
    }


    public function getUsers(){

        $result = DB::table('users')->orderBy('superadmin','DESC')->get();

        return view('new.users', compact('result'));
    }

    public function modelsmanagement()
    {
        $models = DB::connection('mysql2')->table('models')->where('status','Approved')->pluck('Modelname');

        return view('new.modelsmanagement', compact('models'));
    }
}