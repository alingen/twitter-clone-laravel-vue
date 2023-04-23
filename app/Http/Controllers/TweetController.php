<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Tweet;
use Inertia\Inertia;
use App\Models\User;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'text' => 'required|max:140',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);


        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageName = basename($imagePath);
            $validatedData['image'] = $imageName;
        }

        $tweet = auth()->user()->tweets()->create($validatedData);
        $tweet->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet)
    {
        return Inertia::render('TweetDetail', ['tweet' => $tweet, 'users' => User::all(), 'comments' => Comment::where('tweet_id', $tweet->id)->orderBy('created_at', 'desc')->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
