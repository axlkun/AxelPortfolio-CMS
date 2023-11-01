<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index(Request $request){
        $articles = Article::with(['categories'])->latest()->simplePaginate($request->get('limit',10));

        return ArticleResource::collection($articles);
    }

    public function show(Request $request, Article $article){
        $article->load(['categories:name']);
        return new ArticleResource($article);
    }

    public function relatedArticles(Request $request, Article $article)
    {
        $slug = $article->slug;

        $articles = Article::latest()
            ->where('slug', '!=', $slug)
            ->simplePaginate(3);

        return ArticleResource::collection($articles);
    }
}
