<?php

namespace App\Http\Resources;

use App\Models\Team;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'team' => $this->whenLoaded('team'),
            'total_tasks' => $this->total_tasks,
            'tasks_done' => $this->tasks_done,
            'total_hours' => $this->total_hours,
            'wasted_hours' => $this->wasted_hours,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
