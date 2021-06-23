<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class CategoryController extends Controller
{
    private $categoryRepo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return false|string
     */
    public function index()
    {
        if ($data = $this->categoryRepo->all()) {
            return json_encode(["status" => "success", "category" => $data]);
        } else {
            return json_encode(["status" => "error", "message" => "Something is wrong"]);
        }
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
     * @param Request $request
     * @return false|string
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'description' => "required",
            'slug' => "required",
        ]);

        $data = [
            "name" => $request->name,
            "description" => $request->description,
            "slug" => $request->slug,
        ];
        $res = $this->categoryRepo->save($data);
        if($res == "success") {
            return json_encode(["status" => "success", "message" => "Category Data Inserted"]);
        }else if ($res == "category") {
            return json_encode(["status" => "error", "message" => "Category already exists"]);
        }
        else if($res == "error"){
            return json_encode(["status" => "error", "message" => "Something is wrong"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return false|\Illuminate\Http\Response|string
     */
    public function destroy(Category $category,$id)
    {
        return $this->categoryRepo->deleteCategoryData($id);
    }

    public function checkSlugIsAvailable(Request $request)
    {
        return $this->categoryRepo->checkSlugIsAvailable($request->slug);
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($this->categoryRepo->updateCategoryStatus($request->id, $request->status)) {
            return json_encode(["status" => "success", "message" => "Status Update Successfully"]);
        } else {
            return json_encode(["status" => "error", "message" => "Something is wrong"]);
        }
    }

    public function updateCategoryData(Request $request)
    {
        $data = [
            "name"=>$request->name,
            "description"=>$request->description,
            "slug"=>$request->slug,
        ];
        if ($this->categoryRepo->updateCategoryData($data,$request->id)) {
            return json_encode(["status" => "success", "message" => "Category Data Update Successfully"]);
        } else {
            return json_encode(["status" => "error", "message" => "Something is wrong"]);
        }
    }
}
