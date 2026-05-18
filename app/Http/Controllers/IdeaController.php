<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Like;  // Import the Like model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    // Store a new idea
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Create the idea and save it to the database
        $idea = Idea::create([
            'content' => $validated['content'],
            'user_id' => auth()->id(), // Assuming you're using user authentication
        ]);

        // Return a JSON response
        return response()->json(['success' => true, 'idea' => $idea]);
    }

    // Get all ideas
    public function index()
    {
        // Fetch ideas in descending order
        $ideas = Idea::latest()->get();
        return view('dashboard', compact('ideas'));
    }


    // Like or unlike an idea
    public function likeIdea($id)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first.'
            ]);
        }

        $idea = Idea::findOrFail($id);
        $existingLike = Like::where('user_id', auth()->id())
            ->where('idea_id', $id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'idea_id' => $id,
            ]);
            $liked = true;
        }

        $likesCount = Like::where('idea_id', $id)->count();

        return response()->json([
            'success' => true,
            'likes'   => $likesCount,
            'liked'   => $liked        // ✅ yeh add kiya
        ]);
    }
}
