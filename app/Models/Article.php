<?php

namespace App\Models;

use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Contracts\ImageableContract as ContractsImageableContract;

class Article extends Model implements ContractsImageableContract
{
    use HasFactory;
    use Imageable; // permite usar los métodos getImageUrl y deletePhoto

    protected $guarded = ['id'];

    public function uploadFolder():string{
        return "public/articles";
    }

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class,'category_id')->withDefault();
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

}
