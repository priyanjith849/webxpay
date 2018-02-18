<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Session;
use App\SubscriptionPlan;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the subscription
        $subscription = SubscriptionPlan::all();
        // load the view and pass the subscription
        return \View::make('backend.subscription.index')
            ->with('subscription', $subscription);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
        return view('backend.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // validate
        $rules = array(
            'title' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/subscription-plans/create')
                ->withErrors($validator);
        } else {
            // store
            $category = new SubscriptionPlan;
            $category->title  = Input::get('title');
            $category->description  = Input::get('description');
            $category->save();

            // redirect
            Session::flash('message', 'Successfully created category!');
            return Redirect::to('admin/subscription-plans');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = SubscriptionPlan::find($id);
        // Show the page
        return view('backend.subscription.view', compact(
            'category'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = SubscriptionPlan::find($id);
        // Show the page
        return view('backend.subscription.edit', compact(
            'category'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $category = SubscriptionPlan::find($id);
        // validate
        $rules = array(
            'title' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/subscription-plans/edit/'.$id)
                ->withErrors($validator);
        } else {
            // store
            $category->title  = Input::get('title');
            $category->description  = Input::get('description');
            $category->save();

            // redirect
            Session::flash('message', 'Successfully created category!');
            return Redirect::to('admin/subscription-plans');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $category = SubscriptionPlan::find($id);
        $category->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the category!');
        return Redirect::to('admin/subscription-plans');
    }
}
