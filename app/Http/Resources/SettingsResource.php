<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'photo_url' => $this->getImageUrl('data->photo'),
            'description' => $this->getDescription(),

            'about_photo_url' => $this->getImageUrl('data->about_photo'),
            'about_description' => $this->getAboutDescription(),

            'contact_photo_url' => $this->getImageUrl('data->contact_photo'),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'address' => $this->getAddress(),
            'google_map_url' => $this->getGoogleMapUrl(),

            'alt_text' => 'current photo',
        ];
    }
}
