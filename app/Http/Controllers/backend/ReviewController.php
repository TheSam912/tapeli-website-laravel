<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function AllReviews()
    {
        $reviews = Review::latest()->get();

        return view('admin.backend.review.all_reviews', compact('reviews'));
    }

    public function AddReview()
    {
        return view('admin.backend.review.add_review');
    }

    public function StoreReview(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'message' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Default image path
        $imagePath = 'upload/no_image.jpg';

        // If user uploaded an image, store it and override the default
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/review'), $fileName);
            $imagePath = 'upload/review/'.$fileName;
        }

        Review::create([
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'message' => $request->input('message'),
            'image' => $imagePath,
        ]);

        $notification = [
            'message' => 'Review inserted successfully !',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.reviews')->with($notification);
    }
}
