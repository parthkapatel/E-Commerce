<?php


namespace App\Repositories;


use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function save($data)
    {
        $count = $this->product::where("name",$data["name"])->count();
        if($count > 0){
            return "product";
        }else if($count == 0){

            foreach ($data as $key => $value ){
                $this->product[$key] = $value;
            }
            if ($this->product->save()) {
                return "success";
            } else {
                return "error";
            }
        }
    }

    public function all()
    {
        return $this->product::all();
    }

    public function productById()
    {
        // TODO: Implement productById() method.
    }

    public function updateProductStatus($id, $status)
    {
        $existsdata = $this->product::find($id);
        $existsdata->status = $status;
        if($existsdata->save())
            return true;
        else
            return false;
    }

    public function updateProductData($data,$id)
    {
        $existsdata = $this->product::find($id);
        foreach ($data as $key => $value){
            $existsdata[$key] = $value;
        }
        if($existsdata->save())
            return true;
        else
            return false;
    }

    public function deleteProductData($id)
    {
        return $this->product::destroy($id);
    }

    public function checkSlugIsAvailable($slug)
    {
        return $this->product::where('slug', $slug)->count();
    }
}
