<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\Sale;
use Image;

class ProductController extends Controller
{
    //
    public function add_new(Request $request){

        if($request->sale==true){
            $sale=1;
        }else{
            $sale=0;
        }
        $this->validate($request,[
            'product_name'=>'required',
            'price'=>'required|numeric',
            'description'=>'required',
            'stock'=>'required|numeric',
            'category'=>'required',
        ]);
$name='';
        if($request->image){
            $image=$request->image;
            $thumbnailImage = Image::make($image);
            $thumbnailPath = public_path().'/products/';
           
           $name = time().'.' . explode('/', explode(':', substr($request->image, 0, 
            strpos($request->image, ';')))[1])[1];
           $destination=public_path().'/'.'products/';
           $thumbnailImage->save($destination.$name);
          }

        $product=Product::create([
            'product_name'=>$request->product_name,
            'price'=>$request->price,
            'category_id'=>$request->category,
            'description'=>$request->description,
            'stock'=>$request->stock,
            'image'=>$name,
            'sale'=>$sale,

        ]);

        
        
        if($request->sale){
            $this->validate($request,[
            'percentage'=>'required',
            'from'=>'required',
            'to'=>'required',
            
        ]);
            $sale=Sale::create([
                'product_id'=>$product->id,
                'percentage'=>$request->percentage,
                'from'=>$request->from,
                'to'=>$request->to,
            ]);
        }
         return request()->json(['success' => 'Product Added Successfully', 200]);

       
   
    }
    public function get_products(){
        $products=Product::with('category','sale')->get();
        return request()->json(200,$products);
    }
    public function delete_product($id){
        $product=Product::find($id);

        $product->sale()->delete();
        if($product->image){
            unlink(public_path().'/'.'products/'.$product->image);
        }
        
        $product->delete();
        return request()->json(200,'success');
    }
}
