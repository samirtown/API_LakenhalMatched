<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Auth\Events\PasswordReset;
use Validator;
use Illuminate\Support\Facades\Hash;
use Storage;
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

    public function update(Request $request, $user_ID){
        $userUpdate = User::findOrFail($user_ID);

        $userUpdate->naam = $request->get('naam');
        $userUpdate->beroep = $request->get('beroep');
        $userUpdate->favoriete_kunst = $request->get('favoriete_kunst');
        $userUpdate->biografie = $request->get('biografie');

        $userUpdate->save();
    }

    public function updateKenmerk(Request $request, $user_ID){
        $userUpdate = User::findOrFail($user_ID);
        $interesses = json_decode($userUpdate->interesses);
        $eigenschappen = json_decode($userUpdate->eigenschappen);

        if($request->get('interesses') != ""){
            $interesses[] = $request->get('interesses');
            $userUpdate->update(['interesses' => $interesses]);
        }else if($request->get('eigenschappen') != ""){
            $eigenschappen[] = $request->get('eigenschappen');
            $userUpdate->update(['eigenschappen' => $eigenschappen]);
        }

        $userUpdate->save();
        return $userUpdate;
    }

    public function deleteKenmerk(Request $request, $user_ID){
        $kenmerkDelete = User::findOrFail($user_ID);
        $interesses = json_decode($kenmerkDelete->interesses);
        $eigenschappen = json_decode($kenmerkDelete->eigenschappen);

        if($request->get('interesses') != ""){
            if (($key = array_search($request->get('interesses'), $interesses)) !== false) {
                unset($interesses[$key]);
                $interesses = array_values($interesses);
                $kenmerkDelete->update(['interesses' => $interesses]);
            }
        }else if($request->get('eigenschappen') != ""){
            if (($key = array_search($request->get('eigenschappen'), $eigenschappen)) !== false) {
                unset($eigenschappen[$key]);
                $eigenschappen = array_values($eigenschappen);
                $kenmerkDelete->update(['eigenschappen' => $eigenschappen]);
            }
        }
        $kenmerkDelete->save();
        return $kenmerkDelete;
    }

    public function profielFotoUpload(Request $request, $user_ID){
        $profielFotoUser = User::findOrFail($user_ID);
        $uniqueid = uniqid();
        // check if image has been received from form
        if($request->file('profiel_foto')){
            // check if user has an existing avatar
            if($profielFotoUser->profiel_foto != null){
                // delete existing image file
                Storage::disk('profiel_foto')->delete($profielFotoUser->profiel_foto);
            }
    
            // processing the uploaded image
            $extension = $request->file('profiel_foto')->getClientOriginalExtension();
            $profiel_foto_name = $uniqueid.'.'.$extension;
            $profiel_foto_path = $request->file('profiel_foto')->storeAs('', $profiel_foto_name, 'profiel_foto' );

    
            // Update user's avatar column on 'users' table
            $profielFotoUser->profiel_foto = $profiel_foto_path;
            $profielFotoUser->save();
    
            if($profielFotoUser->save()){
                return response()->json([
                    'status'    =>  'success',
                    'message'   =>  'Profile Photo Updated!',
                    'profiel_foto_url'=>  url('storage/profiel_foto/'.$profiel_foto_path)
                ]);
            }else{
                return response()->json([
                    'status'    => 'failure',
                    'message'   => 'failed to update profile photo!',
                    'profiel_foto_url'=> NULL
                ]);
            }
    
        }
        
        return $request->file('profiel_foto');
    }

    protected $user;

    public function __construct(){
        $this->middleware("auth:api",["except" => ["login","register","index","show", "update", "updateKenmerk" ,"deleteKenmerk", "profielFotoUpload", "profielFoto", "forgotPassword", "resetPassword"]]);
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
