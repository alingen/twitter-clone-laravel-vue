<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Tweet;

class UserController extends Controller
{
    public function show()
    {
        return Inertia::render('UserProfile', ['users' => User::first(), 'tweets' => Tweet::first()]);
    }
}
