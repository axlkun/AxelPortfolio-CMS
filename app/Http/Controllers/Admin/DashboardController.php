<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Article;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index(Request $rquest)
    {
        $projectsCount = Project::count();
        $categoriesCount = Category::count();
        $articlesCount = Article::count();

        $latestProject = Project::latest('created_at')->value('created_at') ? Project::latest('created_at')->value('created_at')->diffForHumans() : 'No records available';
        $latestCategory = Category::latest('created_at')->value('created_at') ? Category::latest('created_at')->value('created_at')->diffForHumans() : 'No records available';
        $latestArticle = Article::latest('created_at')->value('created_at') ? Article::latest('created_at')->value('created_at')->diffForHumans() : 'No records available';

        return Inertia::render('Dashboard', [
            'projectsCount' => $projectsCount,
            'categoriesCount' => $categoriesCount,
            'articlesCount' => $articlesCount,
            'latestProject' => $latestProject,
            'latestCategory' => $latestCategory,
            'latestArticle' => $latestArticle,
        ]);
    }
}
