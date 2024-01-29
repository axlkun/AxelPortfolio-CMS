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
            'alt_image' => $this->when($this->alt_image,$this->alt_image),
            'title' => $this->title,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'slug' => $this->when($this->slug,$this->slug),
            'summary' => $this->when($this->summary,$this->summary),
            'meta_description' => $this->when($this->meta_description,$this->meta_description),
            'keywords' => $this->when($this->keywords,$this->keywords),
            'description' => $this->when($this->description,$this->description),
            'small_description' => $this->when($this->description,Str::limit(strip_tags($this->description), 80)),
            'created_at_formated' => $this->when($this->created_at, function(){
                return $this->created_at->diffForHumans();
            }),
            'updated_date' => $this->when($this->updated_at,function() {return $this->updated_at->format('M d, Y');}),
            'created_date' => $this->when($this->created_at,function() {return $this->created_at->format('M d, Y');})
           ];
    }
}
