<?php

namespace App\Http\Resources;

use App\Models\OrederItems;
use App\Http\Resources\OrederItemsResource;
use App\Http\Resources\OrederItemsRresource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderRresource extends JsonResource
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
            'Name User' => $this->users ? $this->users->name : "",
            'Name Driver' => $this->driver ? $this->driver->name : "Not Asign Yet",
            'Note' => $this->note ?? " ",
            'Paid' => $this->paid ?? 0,
            'Total' => $this->total,
            'Discount Value' => $this->discount_value,
            'Sub Total' => $this->sub_total,
            // 'Order Items' => OrederItemsResource::collection($this),
        ];
    }
}
