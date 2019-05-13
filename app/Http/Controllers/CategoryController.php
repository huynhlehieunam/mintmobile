<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Manage categories';
        $allCate = Category::select('id','name')->get();
        //dd($allCate);

        return view('backend.category')->with(compact('pageTitle','allCate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "descript_link"=>"required",
            "logo" => "mimes:jpeg,jpg,png,gif|required",
        ]);
        $name = pathinfo($request->logo, PATHINFO_FILENAME).time().".".pathinfo($request->logo, PATHINFO_EXTENSION);
        $path = $request->logo->store('public/images');


        $category = new Category();
        $category->name = $request->name;
        $category->descript_link = $request->descript_link;
        $category->logo = $path;
        $category->save();

        return response()->json(['msg'=>'Saved','id'=>$category->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        $path = $category->logo;
        //$name = substr($path,strrpos($path,"/")+1);





        $category->logo = base64_encode( Storage::get($path));

        if($category){
            return response()->json($category);
        }else{
            return response('Category not found!', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);


        if ($category->delete()) {
            return response()->json('Deleted');
        } else {
            return response('Category not found!', 404);
        }
    }
}
