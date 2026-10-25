<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    // GET /admin/offer -> បាញ់ទៅកាន់ឯកសារ views/admin/Offer.blade.php
    public function index()
    {
        // ប្រើចងទិន្នន័យចុងក្រោយ និងកាត់ទំព័រម្តង ១០ ទិន្នន័យ
        $offers = Offer::latest()->paginate(10);
        return view('admin.Offer', compact('offers'));
    }

    // GET /admin/offer/add -> បាញ់ទៅកាន់ឯកសារ views/admin/offer/Add.blade.php
    public function create()
{
    $products = Product::all();

    return view('admin.offer.Add', compact('products'));
}

    // POST /admin/offer -> ទទួលទិន្នន័យពី Form បញ្ចូលទៅ Database
    public function store(Request $request)
    {
       $validated = $request->validate([
    'product_id' => 'required|integer|exists:product,product_id',
    'discount'   => 'required|numeric|min:1|max:100',
    'new_price'  => 'required|numeric|min:0',
    'start_date' => 'required|date',
    'end_date'   => 'required|date|after_or_equal:start_date',
]);

        Offer::create($validated);

        // បាញ់ត្រឡប់ទៅកាន់ទំព័របញ្ជីវិញ ជាមួយសារជោគជ័យ
        return redirect()->route('offer.list')
                          ->with('success', 'Offer created successfully.');
    }

    // GET /admin/offer/{offer}/edit -> បាញ់ទៅកាន់ឯកសារ views/admin/offer/Edit.blade.php
    public function edit($id)
    {
        // ស្វែងរក Offer តាមរយៈ offer_id
        $offer = Offer::findOrFail($id);
        $products = Product::all();
        return view('admin.offer.Edit', compact('offer', 'products'));
    }

    // PUT /admin/offer/{offer} -> ទទួលទិន្នន័យកែប្រែទៅ Update ក្នុង Database
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'discount'   => 'required|numeric|min:1|max:100',
            'new_price'  => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $offer = Offer::findOrFail($id);
        $offer->update($validated);

        return redirect()->route('offer.list')
                          ->with('success', 'Offer updated successfully.');
    }

    // DELETE /admin/offer/{offer} -> លុបទិន្នន័យ
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();

        return redirect()->route('offer.list')
                          ->with('success', 'Offer deleted successfully.');
    }
}
