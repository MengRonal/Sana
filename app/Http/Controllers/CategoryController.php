<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. Show the list of all categories
    public function index(Request $request)
    {
        $search = $request->get('search');

        $categories = Category::when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('category_name', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('category_id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.category', compact('categories'));
    }

    // 2. Show the create form
    public function create()
    {
        return view('admin.category.create');
    }

    // 3. Save new category data
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:category,category_name',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    // 4. Show the edit form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    // 5. Update category data
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|unique:category,category_name,' . $id . ',category_id',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // 6. Delete a category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Check first whether any product is using this category
        if ($category->products()->exists()) {
            return redirect()->route('categories.index')
                ->with('error', 'Cannot delete "' . $category->category_name . '" because it is still in use by products.');
        }

        try {
            $category->delete();
        } catch (QueryException $e) {
            // 23000 = Integrity constraint violation
            if ($e->getCode() == '23000') {
                return redirect()->route('categories.index')
                    ->with('error', 'Cannot delete this category because it is in use.');
            }
            throw $e;
        }

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}