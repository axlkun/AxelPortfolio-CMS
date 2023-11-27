<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Actions\UploadFile;

class ArticlesController extends Controller
{
    public function index(Request $request){
        $articles = Article::with(['categories'])->latest()->simplePaginate($request->get('limit',10));

        return ArticleResource::collection($articles);
    }

    public function show(Article $article){
        $article->load(['categories:name']);
        return new ArticleResource($article);
    }

    public function relatedArticles(Article $article)
    {
        $slug = $article->slug;

        $articles = Article::latest()
            ->where('slug', '!=', $slug)
            ->simplePaginate(3);

        return ArticleResource::collection($articles);
    }

    public function storeImage(Request $request, UploadFile $uploadFile){
        
        if($request->hasFile('upload')){
            $fileName = $uploadFile->setFile($request->file('upload'))
            ->setUploadPath((new Article())->uploadFolder())
            ->execute();

            $url = url("/storage/articles/{$fileName}");

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);

        }
    }
}
