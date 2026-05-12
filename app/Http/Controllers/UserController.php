<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers(Request $request)
    {
        $users = User::all();
        return response()->view('users.users', compact('users'));
    }
}
