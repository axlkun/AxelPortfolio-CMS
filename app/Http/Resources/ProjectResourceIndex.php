<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResourceIndex extends JsonResource
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
            'title' => $this->when($this->title,$this->title),
            'slug' => $this->when($this->slug,$this->slug),
            'imageUrl' => $this->getImageUrl(),
            'summary' => $this->when($this->summary,$this->summary), 
            'technologies' => $this->when($this->technologies,json_decode($this->technologies)), 
            'company' => $this->when($this->company,$this->company), 
            'created_at_formated' => $this->when($this->created_at, function(){
                return $this->created_at->diffForHumans();
            })
           ];
    }
}
