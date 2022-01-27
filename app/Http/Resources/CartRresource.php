<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartRresource extends JsonResource
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
            'Product Name' => $this->name,
            'Price' => $this->price,
            'Description' => $this->description ,
            'Category' => $this->category ? $this->category->name : null,
            'Qty' => $this->pivot->qty,
            'Total' => $this->pivot->qty * $this->price,
        ];
    }
}
