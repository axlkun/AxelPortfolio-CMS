<?php

namespace App\Models;

use App\Traits\Imageable;
use App\Contracts\ImageableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model implements ImageableContract
{
    use HasFactory;
    use Imageable;

    protected $guarded = ['id'];

    public function uploadFolder():string{
        return "public/projects";
    }
}
