<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DashboardCategoryController extends Controller
{
    final public const MAX_STRING_CHAR_VALIDATION = 'max:50';
    final public const DASHBOARD_CATEGORY_PATH = '/dashboard/categories';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'title' => 'Category Table',
            'categories' => Category::orderBy('category_name')->get(),
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
            'category_name' => ['required', self::MAX_STRING_CHAR_VALIDATION],
            'slug' => ['required', 'unique:categories', self::MAX_STRING_CHAR_VALIDATION],
            'icon_class' => ['required', self::MAX_STRING_CHAR_VALIDATION],
        ]);

        Category::create($validateData);

        return redirect(self::DASHBOARD_CATEGORY_PATH)->with('success', 'New Category has been created!');
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
            'category_name' => ['required', self::MAX_STRING_CHAR_VALIDATION],
            'icon_class' => ['required', self::MAX_STRING_CHAR_VALIDATION],
        ];

        if ($request->slug !== $category->slug) {
            $rules['slug'] = ['required', 'unique:categories', self::MAX_STRING_CHAR_VALIDATION];
        }

        $validateData = $request->validate($rules);

        Category::where('id', $category->id)->update($validateData);

        return redirect(self::DASHBOARD_CATEGORY_PATH)->with('success', 'The Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            Category::destroy($category->id);
            return redirect(self::DASHBOARD_CATEGORY_PATH)->with('success', 'The category has been deleted!');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect(self::DASHBOARD_CATEGORY_PATH)->with('danger', 'Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.');
            }
        }
    }
}
