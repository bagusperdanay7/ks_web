<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DashboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'title' => 'Category Table',
            'categories' => Category::all()->sortBy('category_name'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create', [
            'title' => 'Create Category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => ['required', 'max:50'],
            'slug' => ['required', 'unique:categories', 'max:50'],
            'icon_class' => ['required', 'max:50'],
        ]);

        Category::create($validateData);

        return redirect('/dashboard/categories')->with('success', "New Category has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', [
            'title' => $category->category_name,
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'title' => 'Update Category',
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'category_name' => ['required', 'max:50'],
            'icon_class' => ['required', 'max:50'],
        ];

        if ($request->slug !== $category->slug) {
            $rules['slug'] = ['required', 'unique:categories', 'max:50'];
        }

        $validateData = $request->validate($rules);

        Category::where('id', $category->id)->update($validateData);

        return redirect('/dashboard/categories')->with('success', 'The Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // TODO: Bikin sesuai laravel try catchnya
        try {
            Category::destroy($category->id);
            return redirect('/dashboard/categories')->with('success', 'The category has been deleted!');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect('/dashboard/categories')->with('danger', 'Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.');
            }
        }
    }
}
