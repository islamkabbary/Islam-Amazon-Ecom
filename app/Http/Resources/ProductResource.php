<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'qty' => $this->qty,
            'product stripe id' => $this->product_stripe_id,
            'category_id' => $this->category ? $this->category->name : "",
            'store_id' => $this->store ? $this->store->name : "",
        ];
    }
}
