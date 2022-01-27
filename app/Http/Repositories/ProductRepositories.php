<?php

namespace App\Http\Repositories;

use App\Http\Filter\FilterHelper;
use App\Http\Interfaces\ProductInterfaces;
use App\Models\Product;
use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Redis;

class ProductRepositories implements ProductInterfaces 
{
    use ApiResponseHelpers;

    public function model()
    {
        return Product::class;
    }

    public function showAllProduct()
    {
        try {
            $product = Product::all();
            return $this->respondWithSuccess(ProductResource::collection($product));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage() . $th->getFile());
        }
    }

    public function createProduct($request)
    {
        DB::beginTransaction();
        try {
            $product = Product::create($request->validated());
            DB::commit();
            return $this->respondCreated(new ProductResource($product));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->respondError($th->getMessage());
        }
    }

    public function showOneProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            return $this->respondWithSuccess(new ProductResource($product));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    public function updateProduct($request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($request->validated());
            return $this->respondWithSuccess(new ProductResource($product));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    public function deleteProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return $this->respondError('Product Deleted Successfully');
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    public function search($request)
    {
        try {
            $filter = $request->only(['keyword','category_ids','store_ids']);
            return $query = FilterHelper::apply(Product::query(), $filter);
            if (count($query)) {
                return $this->respondWithSuccess(ProductResource::collection($query));
            } else return response()->json(['error' => 'Product not found']);
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }
}

//37% = 6:38