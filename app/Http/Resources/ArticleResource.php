<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'imageUrl' => $this->getImageUrl(),
            'title' => $this->title,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'category_id' => $this->when($this->category_id,$this->category_id),
            'slug' => $this->when($this->slug,$this->slug),
            'description' => $this->when($this->description,$this->description),
            'small_description' => $this->when($this->description,Str::limit(strip_tags($this->description), 80)),
            'created_at_formated' => $this->when($this->created_at, function(){
                return $this->created_at->diffForHumans();
            }),
            'created_date' => $this->when($this->created_at,function() {return $this->created_at->format('M d, Y');})
           ];
    }
}
