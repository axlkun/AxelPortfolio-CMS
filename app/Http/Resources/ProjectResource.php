<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image, 
            'description' => $this->description, 
            'technologies' => $this->technologies, 
            'company' => $this->company, 
            'website_link' => $this->website_link, 
            'repo_link' => $this->repo_link, 
            'created_at_formated' => $this->when($this->created_at, function(){
                return $this->created_at->diffForHumans();
            })
           ];
    }
}
