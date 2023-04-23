<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function index()
    {
        return Inertia::render('Top');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'text' => 'required|max:140',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'tweet_id' => 'required|max:20'
        ]);


        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageName = basename($imagePath);
            $validatedData['image'] = $imageName;
        }

        $comment = auth()->user()->comments()->create($validatedData);
        $comment->save();

        return to_route('tweets.show', $request->tweet_id);
    }

    public function show()
    {
        return Inertia::render('Top');
    }
}
