<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;
use App\Notifications\TestNotification;
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

        //通知登録
        $content = (object)[
            'user_id_from' => $comment->user_id,
            'tweet_id' => $request->tweet_id,
            'infomation_type' => 'Comment',
            'infomation_id' => $comment->id
        ];

        $tweet = Tweet::with('user')->find($request->tweet_id);
        $user = $tweet->user;
        $user->notify(new TestNotification(
            $content
        ));

        return to_route('tweets.show', $request->tweet_id);
    }

    public function show()
    {
        return Inertia::render('Top');
    }
}
