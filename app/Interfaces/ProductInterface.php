<?php


namespace App\Interfaces;


interface ProductInterface
{
    public function save($data);

    public function all();

    public function productById();

    public function updateProductStatus($id,$status);

    public function updateProductData($data,$id);

    public function deleteProductData($id);

    public function checkSlugIsAvailable($slug);

}
