<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;

class CategoryController extends Controller
{
    //
    public function add_cat(Request $request){
    	 $this->validate($request,[
    	 	'name'=>'required'
    	 ]);
    	 Category::create([
    	 	'name'=>$request->name
    	 ]);
    	return request()->json(200,'successfully Add New Category');

    	 

    	// return response()->json(['success','updated']);
    }
    public function get_cat(){
    	$categories=Category::all();
    	return request()->json(200,$categories);
    }
    public function delete_cat($id){
    	$cat=Category::find($id);
    	$cat->delete();
    	return request()->json(200,'successfully deleted');
    }
    public function show($id){
    	$cat=Category::find($id);
    	return request()->json(200,$cat);
    }
    public function update(Request $request){
    	$this->validate($request,[
    		'name'=>'required'
    	]);
    	$cat=Category::find($request->id);
    	$cat->name=$request->name;
    	$cat->save();
    	return request()->json(200,'successfully updated');
    }
}
