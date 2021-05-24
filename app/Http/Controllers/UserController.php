<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

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
        $userUpdate->profiel_foto = $request->get('profiel_foto');
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

    protected $user;

    public function __construct(){
        $this->middleware("auth:api",["except" => ["login","register","index","show", "update", "updateKenmerk" ,"deleteKenmerk"]]);
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
        $responseMessage = "Registration Successful";

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
                $responseMessage = "Invalid username or password";
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
            $responseMessage = "Sorry, this user does not exist";
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
}
