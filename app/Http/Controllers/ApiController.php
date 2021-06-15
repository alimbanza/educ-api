<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request)
    {
    	
        $data = $request->only('name', 'email', 'password');

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new user
        $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function authenticate(Request $request)
    {
        //Récupération des informations soumises

        $credentials = $request->only('email', 'password');

        //validation des informations

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Retourne les messages d'erreur lors de la validation des informations

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }


        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

  //      return $this->createNewToken($token);
       
       // authentification de l'utilisateur
      
         try {
             if (! $token = JWTAuth::attempt($credentials)) {
                 return response()->json([
                 	'success' => false,
                 	'message' => 'Login credentials are invalid.',
                 ], 400);
             }
        } catch (JWTException $e) {
    	
	 return $credentials;
             return response()->json([
                 	'success' => false,
                 	'message' => 'Could not create token.',
                 ], 500);
         }
 	
	//Retourne une reponse 
         return response()->json([
             'success' => true,
             'token' => $token,
         ]);
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

		//Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        $user = JWTAuth::authenticate($request->token);
 
        return response()->json(['user' => $user]);
    }
/*
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
*/
}
