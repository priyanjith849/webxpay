<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubscriptionPlan;
use App\Ads;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Session;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the ads
        $ads = Ads::all();

        // load the view and pass the ads
        return \View::make('backend.advertisment.index')
            ->with('ads', $ads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->middleware('auth');
        $allCategories = Category::pluck('title', 'id')->all();
       
        $data = [
            'allCategories' => $allCategories,
        ];
        return view('frontend.ads.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->middleware('auth');
        // validate
        $rules = array(
            'name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('ads/create')
                ->withErrors($validator);
        } else {

            try {
                // store
                $ads = new Ads;
                $ads->name = Input::get('name');
                $ads->description = Input::get('description');
                $ads->subscription_plan_id = Auth::user()->subscription_plan_id;
                $ads->category_id = Input::get('category_id');
                $ads->user_id = Auth::user()->id;
                $ads->email = Input::get('email');
                $ads->phone = Input::get('phone');
                $ads->status = 'PENDING';
                $result = $ads->save();
                // redirect
                Session::flash('message', 'Successfully created ads!');
                return Redirect::to('ads/create');
            } catch (\Exception $e) {
                dd($e);
                return Redirect::to('ads/create')
                    ->withErrors($validator);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $ads = Ads::find($id);
        $data = [
            'ads' => $ads,
        ];
        return view('ads.view')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $allCategories = Category::pluck('title', 'id')->all();
        $ads = Ads::find($id);
        $data = [
            'allCategories'      => $allCategories,
            'ads'            => $ads,
        ];
        return view('backend.advertisment.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $ads = Ads::find($id);
        // validate
        $rules = array(
            'name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/ads/edit/' . $id)
                ->withErrors($validator);
        } else {

            try {
                // store
                $ads->name = Input::get('name');
                $ads->description = Input::get('description');
                $result = $ads->save();

                // redirect
                Session::flash('message', 'Successfully edit ads!');
                return Redirect::to('admin/ads');
            } catch (\Exception $e) {
                Session::flash('error', 'Error edit ads!');
                return Redirect::to('admin/ads/edit/' . $id)
                    ->withErrors($validator);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $ads = Ads::find($id);
        $ads->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the ads!');
        return Redirect::to('admin/ads');
    }


    //To do This logic should be implement in Repository
    public function getValidAds()
    {
         $ads = DB::table('ads')
            ->select('ads.*')
            ->leftJoin('subscription_plans', 'ads.subscription_plan_id', '=', 'subscription_plans.id')
            ->whereRaw("status='PUBLISHED' AND DATE_ADD(ads.published_at,INTERVAL subscription_plans.minutes  MINUTE) > NOW()")
            ->get();
        return $ads;
        
    }

    //To do This logic should be implement in Ads Repository and call from cron job or frontend framwork through update the dom
    public function updateAdsBySubscription(){
        $publishedAds = DB::table('ads')
            ->select('ads.*','subscription_plans.minutes')
            ->leftJoin('subscription_plans', 'ads.subscription_plan_id', '=', 'subscription_plans.id')
            ->whereRaw("status='PUBLISHED'")
            ->get();

        foreach ($publishedAds as $key => $ads) {

            $published_at = $ads->published_at;
            $duration = $ads->minutes;

            $start = Carbon::parse($published_at); 
            $end = Carbon::parse($published_at)->addMinutes($duration);
            
            
            if($start->gt(Carbon::now()) && $end->lt(Carbon::now())){
                $ads = Ads::find($ads->id);
                $ads->status = 'EXPIRED';
                $ads->save();
            }

        }

    }

    //To do This logic should be implement in Ads Repository
    public function oneMinutesBeforeExpire(){
        $ads = DB::table('ads')
            ->select('ads.*')
            ->leftJoin('subscription_plans', 'ads.subscription_plan_id', '=', 'subscription_plans.id')
            ->whereRaw("status='PUBLISHED' AND DATE_ADD(ads.published_at,INTERVAL (subscription_plans.minutes-1)  MINUTE) > NOW()")
            ->get();

        //To do this as queue
        // foreach ($ads->chunk(100) as $user)
        // {
        //     Mail::queue('email.notify', $user, function ($message) {
        
        //     });
        // }

        foreach ($ads as $result) {

            Mail::send('email.notify', $confirmation_code, function($message) {
            $message->to($result->email, $result->title)
                ->subject('Advertisment expire notification');
            });

        }

    }


}
