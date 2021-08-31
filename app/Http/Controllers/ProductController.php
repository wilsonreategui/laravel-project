<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreController;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $product = New Product();
        return view('products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->all();

        if($request->has('image')){
            $image_path = $request->file('image')->store('medias');
            $data['featured_img_url'] = $image_path;
        }

        Product::create($data);

        return redirect()->route('products.index')->with(['status' => 'Success', 'message' => 'Product created successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.create', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStoreRequest $request, Product $product)
    {
        $data = $request->all();

        if($request->has('image')){
            Storage::delete($product->featured_img_url);
            // Storage::get() => Obtiene imagen

            $image_path = $request->file('image')->store('medias');
            $data['featured_img_url'] = $image_path;
        }

        $product->fill($data);
        $product->save();

        return redirect()->route('products.index')->with(['status' => 'Success', 'message' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {   
        try{
            $product->delete();
            $result =['status' => 'Success', 'message' => 'Product Deleted successfully'];

        }catch( \Exception $error){
            $result =['status' => 'error', 'message' => 'Product Cannot Be Deleted Successfully: Foreign Key Problem'];
        }
        return redirect()->route('products.index')->with($result);
    }
}
