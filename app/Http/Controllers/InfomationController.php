<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Infomation;
use App\Models\Tweet;
use App\Models\User;

class InfomationController extends Controller
{
    public function index()
    {
        $tweetIdsOfLoggedInUser = Tweet::where('user_id', auth()->user()->id)->pluck('id');
        $info = Infomation::select('infomations.*', 'tweets.text')
            ->join('tweets', 'infomations.tweet_id', '=', 'tweets.id')
            ->orderBy('created_at', 'desc');

        $notifications = $info->whereIn('tweet_id', $tweetIdsOfLoggedInUser)->get();
        $users = User::find($notifications->pluck('user_id_from'));

        return Inertia::render('InfoIndex', ['notifications' => $notifications, 'users' => $users]);
    }
}
