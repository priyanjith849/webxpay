<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Session;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the categories
        $categories = Category::all();
        // load the view and pass the categories
        return \View::make('backend.categories.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
        return view('backend.categories.create');
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
            return Redirect::to('admin/categories/create')
                ->withErrors($validator);
        } else {
            // store
            $category = new Category;
            $category->title  = Input::get('title');
            $category->description  = Input::get('description');
            $category->save();

            // redirect
            Session::flash('message', 'Successfully created category!');
            return Redirect::to('admin/categories');
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
        $category = Category::find($id);
        // Show the page
        return view('backend.categories.view', compact(
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
        $category = Category::find($id);
        // Show the page
        return view('backend.categories.edit', compact(
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
        $category = Category::find($id);
        // validate
        $rules = array(
            'title' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/categories/edit/'.$id)
                ->withErrors($validator);
        } else {
            // store
            $category->title  = Input::get('title');
            $category->description  = Input::get('description');
            $category->save();

            // redirect
            Session::flash('message', 'Successfully created category!');
            return Redirect::to('admin/categories');
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
        $category = Category::find($id);
        $category->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the category!');
        return Redirect::to('admin/categories');
    }
}
