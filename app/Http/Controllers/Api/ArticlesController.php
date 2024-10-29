<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Actions\UploadFile;
use App\Http\Resources\ArticleResourceIndex;

class ArticlesController extends Controller
{
    public function index(Request $request){
        $articles = Article::with(['categories'])->latest()->simplePaginate($request->get('limit',10));

        return ArticleResourceIndex::collection($articles);
    }

    public function filteredIndex(Request $request)
    {
        // Obtener los parámetros de la solicitud
        $seccion = $request->query('seccion'); // El parámetro de sección
        $limit = $request->query('limit', 10); // El límite, con un valor por defecto de 10

        // Validar el parámetro de sección
        if (is_null($seccion)) {
            return response()->json(['error' => 'El parámetro "seccion" es requerido.'], 400);
        }

        // Filtrar los artículos por la sección y aplicar el límite
        $articles = Article::with('categories')
            ->where('seccion', $seccion)
            ->latest()
            ->limit($limit) // Aplicar el límite de resultados
            ->get(); // Obtener los resultados

        // Retornar la colección de artículos
        return ArticleResourceIndex::collection($articles);
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

        return ArticleResourceIndex::collection($articles);
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

    public function search(Request $request)
    {
    // Obtener el parámetro de búsqueda desde la solicitud
    $query = $request->query('query');

    // Validar que el parámetro no esté vacío
    if (empty($query)) {
        return response()->json(['error' => 'El parámetro "query" es requerido.'], 400);
    }

    // Realizar la búsqueda en los campos especificados y evitar duplicados
    $articles = Article::with('categories')
        ->where(function($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
              ->orWhere('summary', 'LIKE', "%{$query}%")
              ->orWhere('meta_description', 'LIKE', "%{$query}%")
              ->orWhere('keywords', 'LIKE', "%{$query}%");
        })
        ->distinct() // Evitar duplicados
        ->latest()   // Ordenar por los más recientes
        ->paginate(15); // Paginación para la respuesta

    // Retornar los artículos encontrados
    return ArticleResourceIndex::collection($articles);
    }
}
