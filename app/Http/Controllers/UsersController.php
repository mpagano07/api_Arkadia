<?php

namespace App\Http\Controllers;

use Illuminate\Database\Console\Migrations\StatusCommand;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends Controller
{
    function index(Request $request)
    {
        //Eloquent
        $users = User::all();
        return response()->json($users, 200);
    }

    function createUser(Request $request)
    {
        // TODO: Create the user in the DB
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => str_random(60)
        ]);

        return response()->json($user, 201);

    }

    function login(Request $request)
    {
        try {
            $data = $request->all();

            $user = User::where('username', $data['username'])->first();

            if ($user && Hash::check($data['password'], $user->password)) {
                return response()->json($user, 200);
            } else {
                return response()->json(['error' => 'Sin contenido'], 406);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Sin contenido'], 406);
        }
    }
}
