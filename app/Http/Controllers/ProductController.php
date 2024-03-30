<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id); // Assuming your product model is `Product`

        return view('product.show', compact('product'));
    }
    public function add_product()
    {
        $product = Product::latest()->first();
        return view('admin.product.add',compact('product'));
    }
    public function product_submit(Request $request)
{
    if ($request->hasFile('images')) {
        $productId = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'size' => $request->input('size'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
            'offer_price' => $request->input('offer_price'),
            'in_stock' => $request->input('in_stock'),
            'discount' => $request->input('discount'),
            'gender' => $request->input('gender'),

        ])->id;

        foreach ($request->file('images') as $image) {
            $randomName = mt_rand(10000, 99999);

            // Move the file manually to the public/images directory
            $image->move(public_path('images'), $randomName . '.jpg');

            ProductImage::create([
                'product_id' => $productId,
                'image_url' => $randomName . '.jpg' // Update the image URL accordingly
            ]);
        }
        

        

        return response()->json(['message' => 'Your Product has been Added.'], 200);
    } else {
        return response()->json(['message' => 'Image is not uploaded. Please check the size of the image.'], 404);
    }
}
public function edit_product($id)
{
    $product = Product::findOrFail($id);

    return view('admin.product.edit', compact('product'));
}

public function remove_image(Request $request){

    $image = ProductImage::where('image_id',$request->image_id)->first();

    if($image){
        $image->delete();

        return response()->json("Image has been Removed.",200);
    }else{
        return response()->json("There was a problem Removing Image",400);

    }
 
    



}
public function product_update(Request $request){
    
    
        $product_id = $request->product_id;
        $product = Product::findOrFail($request->input('product_id')); // Find the existing product by its ID

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'size' => $request->input('size'),
            'category' => $request->input('category'),
            'gender' => $request->input('gender'),
            'price' => $request->input('price'),
            'offer_price' => $request->input('offer_price'),
            'in_stock' => $request->input('in_stock'),
            'discount' => $request->input('discount'),
        ]);
        
        
        if ($request->hasFile('images')) {


        // Upload and associate new images
        foreach ($request->file('images') as $image) {
            $randomName = mt_rand(10000, 99999);
            $image->move(public_path('images'), $randomName . '.jpg');
        
            ProductImage::create([
                'product_id' => $product_id,
                'image_url' => $randomName . '.jpg' 
            ]);
        }
    } 
        return response()->json(['message' => 'Your Product has been Updated.'], 200);
   
}
public function delete_product(Request $request)
{
    $product = Product::find($request->product_id);

    if ($product) {

        $product->is_allowed = 0;
        $product->save();
        
        return response()->json('Product has been deleted.', 200);
    } else {
        return response()->json('Product not found.', 404);
    }
}
public function reactivate_product(Request $request)
{
    $product = Product::find($request->product_id);

    if ($product) {

        $product->is_allowed = 1;
        $product->save();
        
        return response()->json('Product has been Reactivated.', 200);
    } else {
        return response()->json('Product not found.', 404);
    }
}

public function casual(){

    $products = Product::where('category',2)->where('is_allowed',1)->get();

    return view('product.casualShoes',compact('products'));
}
public function formal(){

    $products = Product::where('category',4)->where('is_allowed',1)->get();

    return view('product.formal',compact('products'));
}
public function sports(){

    $products = Product::where('category',3)->where('is_allowed',1)->get();

    return view('product.sports',compact('products'));
}
public function sneakers(){

    $products = Product::where('category',1)->where('is_allowed',1)->get();

    return view('product.sneakers',compact('products'));
}
public function men(){
    
    $products = Product::where('gender',1)->where('is_allowed',1)->get();

    return view('product.men',compact('products'));
}
public function women(){
    $products = Product::where('gender',2)->where('is_allowed',1)->get();

    return view('product.women',compact('products'));
}
}