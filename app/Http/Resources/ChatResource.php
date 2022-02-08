<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'id' => $this->id,
            'message' => $this->message,
            'sender_id' => $this->sender_id,
            'reciver_id' => $this->reciver_id,
            'file_path' => $this->chatFils,
            'date' => Carbon::parse($this->created_at)->format('m-d'),
            'time' => Carbon::parse($this->created_at)->format('H:i'),
        ];
    }
}
