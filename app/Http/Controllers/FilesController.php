<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FilesController extends Controller
{
    public function show(Request $request)
    {
        
        return $request->user();
    }

    public function showUser(Request $request)
    {
        $user = User::find(2);
        $token = $user->createToken('tokmax');

        return ['token' => $token->plainTextToken]; // 2|MNefbNGkBBPzvsubSvVVVxjeAXN04s1OFzk7441h for user id = 1
        // 3|gw9dlo5DJT4at6dSuY9IPC5Mxg7zfNTBQMnw3hfL
    }
}
