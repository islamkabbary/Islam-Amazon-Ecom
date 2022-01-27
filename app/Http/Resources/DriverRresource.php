<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverRresource extends JsonResource
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
            'Name' => $this->name,
            'Email' => $this->email,
            'Location' => $this->location,
            'Store' => $this->store ? $this->store->name : "",
        ];
    }
}
