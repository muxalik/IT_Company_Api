<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
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
            'name' => ucfirst($this->name),
            'users' => new UserCollection($this->whenLoaded('users')),
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}
