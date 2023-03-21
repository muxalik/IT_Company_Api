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
            'name' => ucfirst($this->name),
            'email' => $this->email,
            'avatar' => $this->avatar,
            'country' => ucfirst($this->country),
            'city' => ucfirst($this->city),
            'languages' => explode(', ', $this->languages),
            'phone' => $this->phone,
            'discord' => $this->discord,
            'tasks_done' => $this->tasks_done,
            'projects_done' => $this->projects_done,
            'wasted_years' => $this->wasted_years,
            'ip_address' => $this->ip_address,
            'skills' => new SkillCollection($this->whenLoaded('skills')),
            'leading_team' => new TeamResource($this->whenLoaded('leadingTeam')),
            'teams' => new TeamCollection($this->whenLoaded('teams')),
            'projects' => new ProjectCollection($this->whenLoaded('projects')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
