<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tweet;
use App\Models\User;
use App\Models\Retweet;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $onlytweets = Tweet::select('retweets.*', 'retweets.user_id AS retweet_user_id', 'tweets.*', 'tweets.created_at AS sort_created_at')
            ->leftjoin('retweets', 'tweets.id', '=', 'retweets.retweetable_type'); //あえて間違えてカラムをつくる
        $retweets = Retweet::select('retweets.*', 'retweets.user_id AS retweet_user_id', 'tweets.*', 'retweets.created_at AS sort_created_at')
            ->join('tweets', 'tweets.id', '=', 'retweets.retweetable_id');

        $tweets = $onlytweets->unionAll($retweets)
            ->orderBy('sort_created_at', 'desc')
            ->get();

        // dd($onlytweets);
        return Inertia::render('Top', ['users' => User::all(), 'tweets' => $tweets, 'retweets' => Retweet::with('user')->get()]);
    }
}
