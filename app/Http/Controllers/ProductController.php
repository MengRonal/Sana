<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 1. បង្ហាញបញ្ជីផលិតផលទាំងអស់
    public function index(Request $request)
    {
        $search = $request->get('search');
        $products = Product::with(['category','supplier'])->paginate(10);
        if (!empty($search)) {
            // បានថែម withQueryString() ដើម្បីរក្សាពាក្យ Search ពេលចុចប្តូរទំព័រ
            $products = Product::where('product_name', 'LIKE', "%{$search}%")
                ->orWhere('product_type', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->paginate(5)
                ->withQueryString();
        } else {
            $products = Product::paginate(5);
        }

        return view('admin.product', compact('products'));
    }

    // 2. បង្ហាញ Form សម្រាប់បង្កើតផលិតផលថ្មី
    public function create()
    {
        $categories = Category::all();
        $suppliers  = Supplier::all();

        return view('admin.product', compact('categories', 'suppliers'));
    }

    // 3. រក្សាទុកទិន្នន័យផលិតផលថ្មីចូល Database
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|unique:products,product_name',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // 4. បង្ហាញ Form កែប្រែទិន្នន័យផលិតផល
    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();
        $suppliers  = Supplier::all();

        return view('admin.product', compact('product', 'categories', 'suppliers'));
    }

    // 5. ធ្វើបច្ចុប្បន្នភាពទិន្នន័យថ្មីទៅក្នុង Database
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name' => 'required|unique:products,product_name,' . $id . ',product_id',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // 6. លុបផលិតផលចោល
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}