<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class PodcastCategoryController extends Controller
{
    public function index(){
        $pageTitle = 'Manage Podcast Category';
        $podcastCategory = Category::latest()->paginate(getPaginate());
        return view('admin.podcast_category.list',compact('podcastCategory','pageTitle'));
    }


    public function store(Request $request){
        $request->validate([
            'name'=>'required|max:255|unique:categories',
        ]);

        $propertyType = new Category();
        $propertyType->name=$request->name;
        $propertyType->status = $request->status ? 1 : 0;
        $propertyType->save();

        $notify[] = ['success', 'Category has been created'];
        return back()->withNotify($notify);

    }

    public function update(Request $request){

        $request->validate([
            'name'         =>  'required|string'
        ]);

        $podcast                = Category::findOrFail($request->id);
        $check =Category::whereNot('id', $podcast->id)->where('name', $request->name)->get();

        if($check->count()>0){
            $notify[]               = ['error','Category name already exists'];
            return redirect()->back()->withNotify($notify);
        }

        $propertyType =Category::findOrFail($request->id);
        $propertyType->name=$request->name;
        $propertyType->status = $request->status ? 1 : 0;
        $propertyType->save();

        $notify[] = ['success', 'Category has been Updated'];
        return back()->withNotify($notify);

    }
}
