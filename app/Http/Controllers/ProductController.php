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

       $search = $request->search;

$products = Product::with(['category', 'supplier'])
    ->when($search, function ($query) use ($search) {
        $query->where('product_name', 'like', "%{$search}%")
              ->orWhere('product_type', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    })
    ->paginate(10)
    ->withQueryString();

return view('admin.product', compact('products'));
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
    $request->validate([
        'product_name' => 'required|unique:product,product_name',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Upload ទៅ public/images
        $image->move(public_path('images'), $imageName);

        // Save តែឈ្មោះ File
        $data['image'] = $imageName;
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

        return view('admin.product.edit', compact('product', 'categories', 'suppliers'));
    }

    // 5. ធ្វើបច្ចុប្បន្នភាពទិន្នន័យថ្មីទៅក្នុង Database
    public function update(Request $request, $id)
    {
           $product = Product::findOrFail($id);

    $request->validate([
        'product_name' => 'required|unique:product,product_name,' . $id . ',product_id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {

        // លុបរូបចាស់
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        // Upload រូបថ្មី
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $imageName);

        // Save ឈ្មោះរូបចូល Database
        $data['image'] = $imageName;
    }

    $product->update($data);

    return redirect()->route('products.index')
                     ->with('success', 'Product updated successfully.');
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