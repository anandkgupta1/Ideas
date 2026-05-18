<?php
namespace App\Http\Controllers;
use App\Models\Idea;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    // Store a new idea
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $idea = Idea::create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);

        return response()->json(['success' => true, 'idea' => $idea]);
    }

    // Get all ideas
    public function index()
    {
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
            $liked = false; // ✅ FIX: track liked status
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'idea_id' => $id,
            ]);
            $liked = true; // ✅ FIX: track liked status
        }

        $likesCount = Like::where('idea_id', $id)->count();

        return response()->json([
            'success' => true,
            'likes'   => $likesCount,
            'liked'   => $liked  // ✅ FIX: return liked status to frontend
        ]);
    }
}