<?php


namespace App\Interfaces;


interface CategoryInterface
{
    public function save($data);

    public function all();

    public function categoryById();

    public function checkSlugIsAvailable($slugText);

    public function updateCategoryStatus($id,$status);

    public function updateCategoryData($data,$id);

    public function deleteCategoryData($id);
}
