<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
// use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
// use Mpdf\Tag\Em;
// use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     * path="/users/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="store",
     * tags={"User"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="nasir.chalo@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */
    public function store(Request $request)
    {

        // $user = User::create([
        //     'name' => 'Admin',
        //     'email' => 'atiar.cse@gmail.com',
        //     'password' => Hash::make('password123'),
        // ]);

        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->tokens()->first();
            if (!empty($token)) {
                $newToken = Str::random(40);
                $token->token = hash('sha256', $newToken);
                $token->save();
                $accessToken = $newToken;
            } 
            else {
                $accessToken = $user->createToken('ApiTokenBearer')->plainTextToken;
            }

            return response()->json([
                'success' => true,
                'userData' => $user,
                'accessToken' => $accessToken,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => __('Invalid E-Mail or Password!'),
        ], 401);
    }
}