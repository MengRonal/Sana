<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. បង្ហាញបញ្ជីផលិតផលទាំងអស់
    public function index(Request $request)
    {
        $search   = $request->search;
        $category = $request->category;

        $products = Product::with(['category', 'supplier'])
            ->when($search, function ($query) use ($search) {
                $query->where('product_name', 'like', "%{$search}%")
                      ->orWhere('product_type', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category_id', $category);
            })
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();

        return view('admin.product', compact('products', 'categories'));
    }

    // 2. បង្ហាញ Form សម្រាប់បង្កើតផលិតផលថ្មី
    public function create()
    {
        $categories = Category::all();
        $suppliers  = Supplier::all();

        return view('admin.product.create', compact('categories', 'suppliers'));
    }

    // 3. រក្សាទុកទិន្នន័យផលិតផលថ្មីចូល Database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|unique:product,product_name',
            'category_id'  => 'nullable|exists:category,category_id',
            'supplier_id'  => 'nullable|exists:suppliers,supplier_id', // <-- ដូរពី supplier មក suppliers
            'price'        => 'required|numeric|min:0',
            'cost'         => 'required|numeric|min:0', 
            'qty'          => 'required|integer|min:0',
            'product_type' => 'nullable|string',
            'status'       => 'nullable|string',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // 4. បង្ហាញ Form កែប្រែទិន្នន័យផលិតផល
    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();
        $suppliers  = Supplier::all();

        return view('admin.product.edit', compact('product', 'categories', 'suppliers'));
    }

    // 5. ធ្វើបច្ចុប្បន្នភាពទិន្នន័យថ្មីទៅក្នុង Database
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'required|unique:product,product_name,' . $id . ',product_id',
            'category_id'  => 'nullable|exists:category,category_id',
            'supplier_id'  => 'nullable|exists:suppliers,supplier_id', // <-- ដូរពី supplier មក suppliers
            'price'        => 'required|numeric|min:0',
            'cost'         => 'required|numeric|min:0', 
            'qty'          => 'required|integer|min:0',
            'product_type' => 'nullable|string',
            'status'       => 'nullable|string',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                @unlink(public_path('images/' . $product->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $validated['image'] = $imageName;
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // 6. លុបផលិតផលចោល
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            @unlink(public_path('images/' . $product->image));
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}