<?php


namespace App\Repositories;


use App\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function save($data): string
    {
        $count = $this->category::where("name",$data["name"])->count();
        if($count > 0){
            return "category";
        }else if($count == 0){
            $this->category->name = $data["name"];
            $this->category->description = $data["description"];
            $this->category->slug = $data["slug"];
            if ($this->category->save()) {
                return "success";
            } else {
                return "error";
            }
        }
    }

    public function all()
    {
        return $this->category::all();
    }

    public function categoryById()
    {
        // TODO: Implement categoryById() method.
    }

    public function checkSlugIsAvailable($slugText)
    {
        return $this->category::where('slug', $slugText)->count();
    }

    public function updateCategoryData($data, $id)
    {
        $existsdata = $this->category::find($id);
        foreach ($data as $key => $value){
            $existsdata[$key] = $value;
        }
        if($existsdata->save())
            return true;
        else
            return false;
    }

    public function updateCategoryStatus($id, $status)
    {
        $existsdata = $this->category::find($id);
        $existsdata->status = $status;
        if($existsdata->save())
            return true;
        else
            return false;
    }

    public function deleteCategoryData($id)
    {
        return $this->category::destroy($id);
    }
}
