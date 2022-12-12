<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\ChatMessages as Message;
use App\Models\User;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SignInandUpController extends Controller
{
     public function __construct()
    {

    }
    /* This Function User Create */

    public function getusers(Request $request){
        $usersList       = User::all(); 
        return response()->json(["status"=>200,"messages"=>"Your Record Submit SucessFully","data"=>$usersList]);
    }
    public function register(Request $request){
        $data    = $request->all();

        /* for this function data validation to user */
        $validation = Validator::make($data,[ 
            'email' => 'required',
            'password' => 'required',
        ]);
    
        /* If data valid any one field that will be return the fail message*/
        if($validation->fails()){
            return $validation->errors()->first();   
        }
        /*this existing user check in this function */
        $existingUser       = User::where('email',$request->email)->count(); 
        if($existingUser>0){
            return response()->json(["status"=>500,"data"=>[],"messages"=>"This Email Already Added"]);
        }

       /*this is password Encryption code */
        $encryptforPassword = base64_encode(openssl_encrypt($request->password,"AES-256-CBC","Encryption Password",0,'1234567891011121'));
        $data               = array("email"=>$request->email,"password"=>$encryptforPassword);
        $recordSubmit       =  User::insert($data); 
        /*in this function is add for user */  
        if($recordSubmit){
            return response()->json(["status"=>200,"data"=>[],"messages"=>"Your Record Submit SucessFully"]);
        }
        else{
            return response()->json(["status"=>500,"data"=>[],"messages"=>"Your Record Submit Failed"]);
        }
    }

    /* user login function */
    public function login(Request $request){
        $data    = $request->all();
       /* for this function data validation to user */
       $validation = Validator::make($data,[ 
            'email' => 'required',
            'password' => 'required',
        ]);

       /* If data valid any one field that will be return the fail message*/
       if($validation->fails()){
         return $validation->errors()->first();   
        }
        /*this is password decryption code */
		$encryptforPassword = base64_encode(openssl_encrypt($request->password,"AES-256-CBC","Encryption Password",0,'1234567891011121'));

        /* get login user details */ 
        $userRecord = User::where('email',$request->email)->where('password',$encryptforPassword)->count(); 
     
        if($userRecord>0){
            return response()->json(["status"=>200,"data"=>[],"messages"=>"Login Successfully"]);
        }else{
            return response()->json(["status"=>500,"data"=>[],"messages"=>"Login Failed"]);
        }
    }
    /*user Forget Password Function */
    public function forgetPassword(Request $request){
        /*get user id */
        $userId = User::where('email',$request->email)->select('_id')->get();

          /*this is password Encryption code */
        $encryptforPassword = base64_encode(openssl_encrypt($request->forget_password,"AES-256-CBC","Encryption Password",0,'1234567891011121'));

        /*update the passowrd for give user email id*/
        $updatePassword     = array('password'=>$encryptforPassword);
        $update             =  User::where('_id',$userId[0]->_id)->update($updatePassword); 

           /*Forget Password Mail function Code */
        if($update){
            $data = array('name'=>"Ranjith Mahrajan");   
            Mail::send(['text'=>'mail'], $data, function($message) {
                $message->to('abc@gmail.com', 'Forget Password')->subject
                    ('Your Forget Updated Succesfully');
                $message->from('xyz@gmail.com','Ranjith Mahrajan');
            });
        }
        if($update){
            return response()->json(["status"=>200,"data"=>[],"messages"=>"Your Forget Password Updated SucessFully"]);
        }else{
            return response()->json(["status"=>500,"data"=>[],"messages"=>"Your Forget Password Updated Failed"]);
        }

    }
	
}
