<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Repositories\CategoryRepositories;

class CategoryController extends Controller
{
    private $category;

    public function __construct(CategoryRepositories $categoryRepositories)
    {
        $this->category = $categoryRepositories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() :JsonResponse
    {
        return $this->category->showAllCategory();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request) :JsonResponse
    {
        return $this->category->createCategory($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) :JsonResponse
    {
        return $this->category->showOneCategory($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id) :JsonResponse
    {
        return $this->category->updateCategory($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) :JsonResponse
    {
        return $this->category->deleteCategory($id);
    }
}
