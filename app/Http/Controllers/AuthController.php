<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
    * Inscription de l'utilisateur et rtourne son token de connexion
    * @param Request $request
    *
    */
    public function register(Request $request)
    {
        try {
            //Validation des donées entrantes
            $validateUser = Validator::make(
                $request->all(),
                [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
                ]
            );

            if($validateUser->fails()) {
                return response()->json([
                    'message' => "Erreur validation",
                    'details' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $token = $user->createToken("auth_token")->plainTextToken;
            return response()->json([
                'message' => 'Utilisateur créer avec succé',
                'token' => $token
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Authentification de l'utilisateur
     * @param Request $request
     *
     */
    public function login(Request $request)
    {
        try {
            //Validation des données entrantes de l'utilisateurs
            $validateUser = Validator::make(
                $request->all(),
                [
                'email' => 'required|email',
                'password' => 'required'
            ]
            );
            //Retour des erreurs validation
            if($validateUser->fails()) {
                return response()->json([
                    'message' => "Erreur validation",
                     'details' => $validateUser->errors()
                ], 401);
            }

            //Retour en cas d'un compte utilisateur introuvable dans la base de donées
            if(!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'message' => 'Email ou mot de passe incorrect',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken("auth_token")->plainTextToken;
            return response()->json([
                'message' => 'Connexion reussie !',
                'token' =>  $token
            ], 200);


        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }

    }


    /**
     * Recuperation de données de l'utilisateur connecté
     * @return User
     */
    public function me(Request $request)
    {
        return $request->user();
    }


    /**
     * Suppression du token de l'utilisateur
     */
    public function revokeToken(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message' => "Utilisateur déconnecté"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }



}
