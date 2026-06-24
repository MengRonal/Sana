<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. បង្ហាញបញ្ជីផលិតផលទាំងអស់
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // 2. បង្ហាញ Form បង្កើតផលិតផលថ្មី
    public function create()
    {
        return view('products.create');
    }

    // 3. រក្សាទុកទិន្នន័យផលិតផលថ្មីចូល Database
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
        ]);

        $data = $request->all();

        // លក្ខខណ្ឌ Upload រូបភាព (ប្រសិនបើមាន)
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // 4. បង្ហាញ Form កែប្រែទិន្នន័យ
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // 5. កែប្រែទិន្នន័យថ្មីទៅក្នុង Database
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // 6. លុបផលិតផលចោល
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}