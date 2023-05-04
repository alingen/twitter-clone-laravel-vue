<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;

class RetweetController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {
        $retweet = $tweet->retweets()->create([
            'user_id' => auth()->user()->id,
        ]);
        if ($retweet->save()) {
            to_route('top');
        } else {
            render('top');
        }

        //リツイートするのツイートを複製
        $oldrow = Tweet::find($tweet->id);
        $oldrow->retweet = true;
        $oldrow->save();
    }

    public function destroy(Tweet $tweet)
    {
        $retweet = $tweet->retweets()->where('user_id', auth()->user()->id);
        if ($retweet->delete()) {
            to_route('top');
        } else {
            render('top');
        }
    }
}
