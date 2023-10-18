<?php

namespace App\Models;

use App\Contracts\ImageableContract;
use App\Traits\Imageable;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settings extends Model implements ImageableContract
{
    use HasFactory;
    use Imageable;

    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array'
    ];

    public function uploadFolder():string{
        return "public/settings";
    }

    // Hero
    public function getDescription(): ?string{
        return Arr::get($this->data,'description');
    }

    //About
    public function getAboutDescription(): ?string{
        return Arr::get($this->data,'about_description');
    }

    // Contact
    public function getEmail(): ?string{
        return Arr::get($this->data,'email');
    }

    public function getPhone(): ?string{
        return Arr::get($this->data,'phone');
    }

    public function getAddress(): ?string{
        return Arr::get($this->data,'address');
    }

    public function getGoogleMapUrl(): ?string{
        return Arr::get($this->data,'google_map_url');
    }
}
