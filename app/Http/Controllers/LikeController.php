<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Notifications\TestNotification;
use App\Models\User;
use App\Models\Infomation;


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

        $content = Infomation::create([
            'user_id_from' => $like->user_id,
            'tweet_id' => $tweet->id,
            'infomation_type' => 'Like',
            'infomation_id' => $like->id
        ]);

        $user = User::find($tweet->user_id);
        $user->notify(new TestNotification(
            $content
        ));
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
