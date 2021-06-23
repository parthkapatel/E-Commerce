<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'id' => "required",
            'image_path' => "required",
        ]);

        //dd($request->image_path);
        foreach ($request->image_path as $val){
            dd($val);
        }
        if($request->file()) {
            $file_name = time() . '_' . $request->image_path->getClientOriginalName();
            $file_upload = $request->file('image_path')->move('assets/img/products/', $file_name);
            $file_path = "/assets/img/products/" . $file_name;
           // return $this->movieDetails->save($request, $file_path);
            dd($file_name);
        }

        //$res = $this->productRepo->save($data);
        /*if($res == "success") {
            return json_encode(["status" => "success", "message" => "Product Data Inserted"]);
        }else if ($res == "product") {
            return json_encode(["status" => "error", "message" => "Product already exists"]);
        }
        else if($res == "error"){
            return json_encode(["status" => "error", "message" => "Something is wrong"]);
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductImages  $product_Images
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImages $product_Images)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductImages  $product_Images
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImages $product_Images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductImages  $product_Images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductImages $product_Images)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductImages  $product_Images
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductImages $product_Images)
    {
        //
    }
}
