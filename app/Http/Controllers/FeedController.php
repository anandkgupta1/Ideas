<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function showFeedbackForm()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('feed');
    }

    public function storeFeedback(Request $request)
    {
        // Validation matches string values for rating
        $request->validate([
            'rating' => 'required|string|in:Fair,Good,Very Good,Excellent',
            'comments' => 'required|string',
        ]);

        // Save feedback
        Feedback::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comments' => $request->comments,
        ]);

        // Redirect with success message
        return redirect()->route('dashboard')->with('success', 'Thank you for your valuable feedback!');
    }
}
