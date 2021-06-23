<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return false|string
     */
    public function index()
    {
        if ($data = $this->productRepo->all()) {
            return json_encode(["status" => "success", "product" => $data]);
        } else {
            return json_encode(["status" => "error", "message" => "Something is wrong"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'description' => "required",
            'slug' => "required",
            'unit_price'=>'required',
            'MRP'=>'required',
        ]);

        $data = [
            "name" => $request->name,
            "description" => $request->description,
            "slug" => $request->slug,
            "unit_price"=>$request->unit_price,
            "MRP"=>$request->MRP
        ];
        $res = $this->productRepo->save($data);
        if($res == "success") {
            return json_encode(["status" => "success", "message" => "Product Data Inserted"]);
        }else if ($res == "product") {
            return json_encode(["status" => "error", "message" => "Product already exists"]);
        }
        else if($res == "error"){
            return json_encode(["status" => "error", "message" => "Something is wrong"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return false|Response|string
     */
    public function destroy(Product $product,Request $request)
    {
        return $this->productRepo->deleteProductData($request->id);
    }

    public function checkSlugIsAvailable(Request $request){
        return $this->productRepo->checkSlugIsAvailable($request->slug);
    }

    public function updateProductStatus(Request $request)
    {
        if ($this->productRepo->updateProductStatus($request->id, $request->status)) {
            return json_encode(["status" => "success", "message" => "Status Update Successfully"]);
        } else {
            return json_encode(["status" => "error", "message" => "Something is wrong"]);
        }
    }

    public function updateProductData(Request $request)
    {
        $data = [
            "name"=>$request->name,
            "description"=>$request->description,
            "unit_price"=>$request->unit_price,
            "MRP"=>$request->MRP,
        ];
        if ($this->productRepo->updateProductData($data,$request->id)) {
            return json_encode(["status" => "success", "message" => "Product Data Update Successfully"]);
        } else {
            return json_encode(["status" => "error", "message" => "Something is wrong"]);
        }
    }
}
