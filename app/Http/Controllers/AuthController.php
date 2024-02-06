<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Check user credentials.
     *
     * @param Request $request description
     * @throws \Exception description of exception
     * @return Response
     */
   public function login(Request $request): Response
   {
       $user = User::where('email', $request->email)->first();
       if (!$user || !Hash::check($request->password, $user->password)) {
           return response([
               'message' => ['These credentials do not match our records.']
           ], 404);
       }

       $token = $user->createToken('my-app-token', ['create'])->plainTextToken;

       $response = [
           'user' => $user,
           'token' => $token
       ];

       return response($response, 201);
   }
}
