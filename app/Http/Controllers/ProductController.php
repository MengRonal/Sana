<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 1. Show the list of all products
    public function index(Request $request)
    {
        $search   = $request->search;
        $category = $request->category;

        $products = Product::with(['category', 'supplier'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                // Group the OR conditions so they don't break the other filters
                $query->where(function ($q) use ($search) {
                    $q->where('product_name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            // filled() returns true for "0", so Type = 0 (Non-Stock) works too
            ->when($request->filled('type'), function ($query) use ($request) {
                $query->where('product_type', $request->type);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('product_id', 'desc')
            ->paginate(15)
            ->withQueryString();

        $categories = Category::orderBy('category_name')->get();

        // Statuses taken from the database so they always match real values
        $statuses = Product::whereNotNull('status')
            ->where('status', '!=', '')
            ->distinct()
            ->orderBy('status')
            ->pluck('status');

        return view('admin.product', compact('products', 'categories', 'statuses'));
    }

    // 2. Show the create form
    public function create()
    {
        $categories = Category::all();
        $suppliers  = Supplier::all();

        return view('admin.product.create', compact('categories', 'suppliers'));
    }

    // 3. Save a new product
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

            // Upload to public/images
            $image->move(public_path('images'), $imageName);

            // Save only the file name
            $data['image'] = $imageName;
        }

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    // 4. Show the edit form
    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();
        $suppliers  = Supplier::all();

        return view('admin.product.edit', compact('product', 'categories', 'suppliers'));
    }

    // 5. Update a product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name' => 'required|unique:product,product_name,' . $id . ',product_id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {

            // Delete the old image
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }

            // Upload the new image
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

    // 6. Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        try {
            // Delete the DB row first. If it is in use (FK constraint), this throws
            // before we touch the image file, so the image is never lost by mistake.
            $product->delete();
        } catch (QueryException $e) {
            // 23000 = Integrity constraint violation (e.g. 1451: used by order items)
            if ($e->getCode() == '23000') {
                return redirect()->route('products.index')
                    ->with('error', 'Cannot delete "' . $product->product_name . '" because it is still in use (e.g. in orders).');
            }
            throw $e;
        }

        // Delete the image file only after the product was deleted successfully
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}