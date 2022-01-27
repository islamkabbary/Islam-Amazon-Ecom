<?php

namespace App\Http\Repositories;

use App\Models\Category;
use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CategoryResource;
use App\Http\Interfaces\CategoryInterfaces;


class CategoryRepositories implements CategoryInterfaces
{
    use ApiResponseHelpers;

    public function model()
    {
        return Category::class;
    }

    public function showAllCategory()
    {
        try {
            $category = Category::all();
            return $this->respondWithSuccess(CategoryResource::collection($category));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    public function createCategory($request)
    {
       DB::beginTransaction();
       try {
           $category = Category::create($request->all());
           DB::commit();
           return $this->respondCreated(new CategoryResource($category));
       } catch (\Throwable $th) {
           DB::rollBack();
           return $this->respondError($th->getMessage());
       }
    }

    public function showOneCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            return $this->respondWithSuccess(new CategoryResource($category));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }
 
    public function updateCategory($request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->fill($request->validated())->save();
            return $this->respondWithSuccess(new CategoryResource($category));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }
 
    public function deleteCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            if (count($category->childrens)) {
                return $this->respondError('Category Has Sub Category');
            }
            else{
                $category->delete();
                return $this->respondError("Category Deleted Successfully");
            }
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }
}
