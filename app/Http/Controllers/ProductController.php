<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        
        return view('createProduct');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->file('thumbnail')) {
            $thumbnailImage = $request->file('thumbnail');
            $thumbnailImageName = date('YmdHi') . $thumbnailImage->getClientOriginalName();
            Image::make($thumbnailImage)->save('photos/'.$thumbnailImageName);
            $save_url = 'photos/'.$thumbnailImageName;
        }
        Product::create([
            'name' => $input['name'],
            'sku' => $input['sku'],
            'thumbnail' => $thumbnailImageName,
            'description' => $input['description'],
            'carat' => $request->carat,
            'weight' => $request->weight,
            'bangla_weight' => $request->bangla_weight
           
        ]);


        $notification = array(
            'message' => 'New Product added!',
            'alert-type' => 'success'
        );
        return redirect()->route('addProductPage')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $Product)
    {
        $products = Product::all();
        return view('productList', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $Product)
    {
        $id = $request->update_productId;
        $input = $request->all();

       $product =  Product::find($id);

       if ($request->file('update_thumbnail')) {
        $thumbnailImage = $request->file('update_thumbnail');
        $thumbnailImageName = date('YmdHi') . $thumbnailImage->getClientOriginalName();
        Image::make($thumbnailImage)->save('photos/'.$thumbnailImageName);
        $save_url = 'photos/'.$thumbnailImageName;

        $product->update([
            'name' => $input['update_name'],
            'sku' => $input['update_sku'],
            'thumbnail' => $thumbnailImageName,
            'description' => $input['update_description'],
            
        ]);


    }
    else{
        $product->update([
            'name' => $input['update_name'],
            'sku' => $input['update_sku'],
            'description' => $input['update_description'],
            
        ]);

    }
       
        $notification = array(
            'message' => 'Product updated!',
            'alert-type' => 'success'
        );
        return redirect()->route('addProductPage')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $Product)
    {
        $id = $request->product_id;
        Product::find($id)->delete();
        
        
        $notification = array(
            'message' => 'Product Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->route('addProductPage')->with($notification);
        
    }
}
