<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Auth\Events\PasswordReset;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function show($user_ID){
        return User::where('user_ID','=',$user_ID)->first();
    }
    
    public function index(){
        return User::all();
    }

    protected $user;

    public function __construct(){
        $this->middleware("auth:api",["except" => ["login","register", "forgotPassword", "resetPassword","index","show"]]);
        $this->user = new User;
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'naam' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->toArray()
            ], 500);
        }

        $data = [
            "naam" => $request->naam,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ];

        $this->user->create($data);
        $responseMessage = "Registratie voltooid!";

        return response()->json([
            'success' => true,
            'message' => $responseMessage
        ], 200);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required|min:5',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->toArray()
            ], 500);
        }

        $credentials = $request->only(["email","password"]);
        $user = User::where('email',$credentials['email'])->first();

        if($user){

            if(!auth()->attempt($credentials)){
                $responseMessage = "Foute gebruikersnaam of wachtwoord";
                return response()->json([
                    "success" => false,
                    "message" => $responseMessage,
                    "error" => $responseMessage
                ], 422);
            }

            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            $responseMessage = "Login Successful";
            return $this->respondWithToken($accessToken,$responseMessage,auth()->user());
        }

        else{
            $responseMessage = "Sorry, deze gebruiker bestaat niet";
            return response()->json([
                "success" => false,
                "message" => $responseMessage,
                "error" => $responseMessage
            ], 422);
        }
    }

    public function viewProfile(){
        $responseMessage = "user profile";
        $data = Auth::guard("api")->user();
        return response()->json([
            "success" => true,
            "message" => $responseMessage,
            "data" => $data
        ], 200);
    }

    public function logout(){
        $user = Auth::guard("api")->user()->token();
        $user->revoke();
        $responseMessage = "successfully logged out";
        return response()->json([
            'success' => true,
            'message' => $responseMessage
        ], 200);
    }

    public function forgotPassword(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT 
            ? response()->json([
                'success' => true,
                'message' => 'Reset mail verstuurd!'
            ]) 
            : response()->json([
                'success' => false,
                'message' => 'Er is geen gebruiker met dit email adres gevonden...'
            ]);
    }

    public function resetPassword(Request $request) {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $validator = Validator::make($request->all(),[
                'token' => 'required',
                'password' => 'required|min:5|confirmed',
            ]);

            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => $validator->messages()->toArray()
                ], 500);
            }

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            ); 
            
            return $status == Password::PASSWORD_RESET
                ? response()->json([
                    'success' => true,
                    'message' => "Wachtwoord is gewijzigd!"
                ])
                : response()->json([
                    'success' => false,
                    'message' => "Er is iets mis gegaan..."
                ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Er is geen gebruiker met dit email adres gevonden..."
            ]);
        }

    }
}
