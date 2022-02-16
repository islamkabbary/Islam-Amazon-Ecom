<?php

namespace App\Http\Repositories;

use App\Models\Product;
use App\Trait\ApiPagination;
use F9Web\ApiResponseHelpers;
use App\Http\Filter\FilterHelper;
use Illuminate\Support\Facades\DB;
use App\Events\CreateProductInStrip;
use App\Http\Resources\ProductResource;
use App\Events\DeleteProductInStripeEvent;
use App\Events\UpdateProductInStripeEvent;
use App\Http\Interfaces\ProductInterfaces;

class ProductRepositories implements ProductInterfaces 
{
    use ApiResponseHelpers;
    use ApiPagination;

    public function model()
    {
        return Product::class;
    }

    public function showAllProduct()
    {
        try {
            $product = Product::paginate(1);
            $re      = ProductResource::collection($product); 
            return $this->getPaginationData($product,$re);
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage() . $th->getFile());
        }
    }

    public function createProduct($request)
    {
        DB::beginTransaction();
        try {
            $product = Product::create($request->validated());
            // event(new CreateProductInStrip($product));
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
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->update($request->validated());
            event(new UpdateProductInStripeEvent($product));
            DB::commit();
            return $this->respondWithSuccess(new ProductResource($product));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->respondError($th->getMessage());
        }
    }

    public function deleteProduct($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            event(new DeleteProductInStripeEvent($product));
            DB::commit();
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