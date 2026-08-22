<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::with(['order', 'customer'])
            ->when($request->rating, fn ($q) => $q->where('rating', $request->rating))
            ->latest('review_id')
            ->paginate(15);

        $avgRating = round(Review::avg('rating') ?? 0, 1);

        return view('admin.review', compact('reviews', 'avgRating'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $orders = Order::whereDoesntHave('review')->orderBy('order_id', 'desc')->get();

        return view('admin.reviews.create', compact('customers', 'orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id|unique:reviews,order_id',
            'customer_id' => 'required|exists:customer,customer_id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'Review added.');
    }

    public function edit(Review $review)
    {
        $customers = Customer::orderBy('name')->get();

        return view('admin.reviews.edit', compact('review', 'customers'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customer,customer_id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review->update($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('success', 'Review removed.');
    }
}