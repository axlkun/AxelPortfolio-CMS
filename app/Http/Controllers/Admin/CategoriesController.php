<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    public function index()
    {
        return Inertia::render('Categories/Index', [
            'categories' => CategoryResource::collection(Category::latest()->simplePaginate(10))
        ]);
    }

    public function create()
    {
        return Inertia::render('Categories/Create', [
            "edit" => false,
            "category" => (object)[]
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', Rule::unique(Category::class)]
        ]);

        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category stored successfully');
    }

    public function edit(Category $category)
    {
        return Inertia::render('Categories/Create', [
            "edit" => true,
            "category" => new CategoryResource($category)
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', Rule::unique(Category::class)->ignore($category->id)]
        ]);

        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {

        // Verifica si la categoría tiene asociados artículos
        if ($category->articles->count() > 0) {
            return redirect()->route('categories.index')
            ->with('failure', 'Category cannot be deleted because it is associated with one or more articles.');
        }


        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
