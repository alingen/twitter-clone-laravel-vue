<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;


class LikeController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {
        $like = $tweet->likes()->create([
            'user_id' => auth()->user()->id,
        ]);
        if ($like->save()) {
            to_route('top');
        } else {
            render('top');
        }
    }
    public function destroy(Tweet $tweet)
    {
        $like = $tweet->likes()->where('user_id', auth()->user()->id);
        if ($like->delete()) {
            to_route('top');
        } else {
            render('top');
        }
    }
}
