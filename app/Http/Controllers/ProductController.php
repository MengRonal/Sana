<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Index
    public function index()
    {
        $products = Product::with(['category','supplier'])
                ->paginate(10);

    return view('admin.product', compact('products'));
    return view('admin.category', compact('categories'));
    }

    // Create
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('admin.product.create',
            compact('categories','suppliers'));
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'product_name'=>'required',
            'price'=>'required',
            'qty'=>'required'
        ]);

        $imageName = null;

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'),$imageName);
        }

        Product::create([
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'supplier_id'=>$request->supplier_id,
            'price'=>$request->price,
            'qty'=>$request->qty,
            'product_type'=>$request->product_type,
            'image'=>$imageName,
            'description'=>$request->description,
            'status'=>$request->status
        ]);

        return redirect()->route('product.index')
            ->with('success','Product Added');
    }

    // Edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('admin.product.edit',
            compact('product','categories','suppliers'));
    }

    // Update
    public function update(Request $request,$id)
    {
        $product = Product::findOrFail($id);

        $imageName = $product->image;

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'),$imageName);
        }

        $product->update([
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'supplier_id'=>$request->supplier_id,
            'price'=>$request->price,
            'qty'=>$request->qty,
            'product_type'=>$request->product_type,
            'image'=>$imageName,
            'description'=>$request->description,
            'status'=>$request->status
        ]);

        return redirect()->route('product.index')
            ->with('success','Product Updated');
    }

    // Delete
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect()->route('product.index')
            ->with('success','Product Deleted');
    }
}