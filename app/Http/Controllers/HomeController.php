<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;
use App\Ads;


class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $ads = DB::table('ads')
            ->select('ads.*')
            ->leftJoin('subscription_plans', 'ads.subscription_plan_id', '=', 'subscription_plans.id')
            ->whereRaw("status='PUBLISHED' AND DATE_ADD(ads.published_at,INTERVAL subscription_plans.minutes  MINUTE) > NOW()")
            ->get();

        $data = [
            'allAds' => $ads,
        ];

        return view('welcome')->with($data);
    }

}