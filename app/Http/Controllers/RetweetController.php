<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Notifications\TestNotification;
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

        //リツイートされたツイートに証拠残す
        $oldrow = Tweet::find($tweet->id);
        $oldrow->retweet = true;
        $oldrow->save();

        $content = (object)[
            'user_id_from' => $retweet->user_id,
            'tweet_id' => $tweet->id,
            'infomation_type' => 'Retweet',
            'infomation_id' => $retweet->id
        ];

        $user = User::find($tweet->user_id);
        $user->notify(new TestNotification(
            $content
        ));
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
