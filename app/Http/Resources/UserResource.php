<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar, 
            'country' => $this->country,
            'city' => $this->city, 
            'languages' => explode(', ', $this->languages),
            'phone' => $this->phone,
            'discord' => $this->discord, 
            'tasks_done' => $this->tasks_done,
            'projects_done' => $this->projects_done,
            'wasted_years' => $this->wasted_years,
            'ip_address' => $this->ip_address,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'skills' => $this->whenLoaded('skills'),
            'projects' => $this->whenLoaded('projects'),
            'teams' => $this->whenLoaded('teams'),
            'leading_team' => $this->whenLoaded('leadingTeam'),
        ];
    }
}
