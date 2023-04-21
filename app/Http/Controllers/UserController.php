<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Tweet;

class UserController extends Controller
{
    public function show(User $user)
    {

        return Inertia::render('UserProfile', ['user' => $user, 'tweets' => Tweet::orderBy('created_at', 'desc')->where('user_id', $user->id)->get()]);
    }
}
