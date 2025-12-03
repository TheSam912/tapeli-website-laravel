<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function AllReviews()
    {
        $reviews = Review::latest()->get();

        return view('admin.backend.review.all_reviews', compact('reviews'));
    }
}
