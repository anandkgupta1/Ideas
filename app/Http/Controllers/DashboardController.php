<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use App\Models\Feedback;
use App\Models\Follow;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        $ideas = Idea::all();
        
        // Get all feedbacks, including associated user details
        $feedbacks = Feedback::with('user')->get();

        return view('dashboard', compact('users', 'ideas', 'feedbacks'));
    }

    public function followUser(Request $request, $followed_id)
    {
        $follower_id = auth()->id(); // Get logged-in user's ID
        $action = $request->input('action');
    
        if ($action == 'follow') {
            // Check if the user is already following
            $existingFollow = Follow::where('follower_id', $follower_id)
                                    ->where('followed_id', $followed_id)
                                    ->first();
    
            if ($existingFollow) {
                return response()->json(['message' => 'Already following']);
            }
    
            // Store the follow action
            Follow::create([
                'follower_id' => $follower_id,
                'followed_id' => $followed_id,
            ]);
    
            return response()->json(['message' => 'Following']);
        }
    
        if ($action == 'unfollow') {
            // Remove the follow relationship
            Follow::where('follower_id', $follower_id)
                  ->where('followed_id', $followed_id)
                  ->delete();
    
            return response()->json(['message' => 'Unfollowed']);
        }
    
        return response()->json(['message' => 'Invalid action']);
    }

    
    public function search(Request $request)
{
    $searchQuery = $request->input('search');

    if ($searchQuery) {
        // Search for users by name
        $users = User::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
                     ->with('ideas')
                     ->get();
        
        // Optionally, you can also search ideas if you want
        $ideas = Idea::where('content', 'LIKE', '%' . $searchQuery . '%')->get();
    } else {
        // Fetch all users and their ideas if no search query is provided
        $users = User::with('ideas')->get();
        $ideas = Idea::all();
    }

    return view('dashboard', compact('users', 'ideas'));
}

}