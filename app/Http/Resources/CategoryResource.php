<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
        'name' => $this->name,
        'slug' => $this->when($this->slug,$this->slug),
        'created_at_formated' => $this->when($this->created_at, function(){
            return $this->created_at->diffForHumans();
        }) 
       ];
    }
}
