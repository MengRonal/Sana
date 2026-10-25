<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // ==========================================
    // 1. បង្ហាញបញ្ជី Review និង ពិន្ទុមធ្យម (Average Rating)
    // ==========================================
    public function index(Request $request)
    {
        $reviews = Review::with(['order', 'customer'])
            ->when($request->rating, fn ($q) => $q->where('rating', $request->rating))
            ->latest('review_id')
            ->paginate(15);

        $avgRating = round(Review::avg('rating') ?? 0, 1);

        return view('admin.review', compact('reviews', 'avgRating'));
    }

    // ==========================================
    // 2. Form បង្កើត Review ថ្មី
    // ==========================================
    public function create()
    {
        $customers = Customer::orderBy('customer_id', 'desc')->get();
        
        // 💡 ទាញយកតែ Order ណាដែលបាន Delivered/Completed និងមិនទាន់មាន Review
        $orders = Order::where('status', 'completed')
            ->whereDoesntHave('review')
            ->orderBy('order_id', 'desc')
            ->get();

        return view('admin.review.create', compact('customers', 'orders'));
    }

    // ==========================================
    // 3. រក្សាទុក Review ថ្មី
    // ==========================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id'    => 'required|exists:orders,order_id|unique:reviews,order_id',
            'customer_id' => 'required|exists:customer,customer_id',
            'rating'      => 'required|integer|min:1|max:5',
            'comment'     => 'nullable|string',
        ]);

        Review::create($validated);

        return redirect()->route('admin.review.index')->with('success', 'Review added successfully.');
    }

    // ==========================================
    // 4. Form កែប្រែ Review
    // ==========================================
    public function edit(Review $review)
    {
        $customers = Customer::orderBy('customer_id', 'desc')->get();

        return view('admin.review.edit', compact('review', 'customers'));
    }

    // ==========================================
    // 5. Update Review
    // ==========================================
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customer,customer_id',
            'rating'      => 'required|integer|min:1|max:5',
            'comment'     => 'nullable|string',
        ]);

        $review->update($validated);

        return redirect()->route('admin.review.index')->with('success', 'Review updated successfully.');
    }

    // ==========================================
    // 6. លុប Review
    // ==========================================
    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('success', 'Review removed.');
    }
}