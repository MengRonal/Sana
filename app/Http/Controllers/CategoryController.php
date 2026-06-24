<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. បង្ហាញបញ្ជីប្រភេទផលិតផលទាំងអស់
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // 2. បង្ហាញ Form សម្រាប់បង្កើតប្រភេទផលិតផលថ្មី
    public function create()
    {
        return view('categories.create');
    }

    // 3. រក្សាទុកទិន្នន័យប្រភេទផលិតផលថ្មីចូល Database
    public function store(Request $request)
    {
        // បានកែពី unique:categories ទៅជា unique:category
        $request->validate([
            'category_name' => 'required|unique:category,category_name',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // 4. បង្ហាញ Form កែប្រែទិន្នន័យប្រភេទផលិតផល
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // 5. ធ្វើបច្ចុប្បន្នភាពទិន្នន័យថ្មីទៅក្នុង Database
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // បានកែពី unique:categories ទៅជា unique:category
        $request->validate([
            'category_name' => 'required|unique:category,category_name,' . $id . ',category_id',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // 6. លុបប្រភេទផលិតផលចោល
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}