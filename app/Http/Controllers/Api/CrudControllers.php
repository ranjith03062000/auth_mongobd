<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Crud;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CrudControllers extends Controller
{
     public function __construct()
    {

    }

    public function add_uesr(Request $request){
        $data = $request->all();

        /* for this function data validation to user */
        $validation = Validator::make($data,[ 
            'name' => 'required',
            'branch' => 'required',
            'designation' => 'required',
        ]);
    
        /* If data valid any one field that will be return the fail message*/
        if($validation->fails()){
            return $validation->errors()->first();   
        }
        $recordSubmit  =Crud::insert(["name"=>$request->name,"branch"=>$request->branch,"designation"=>$request->designation]); 
        if($recordSubmit){
              return response()->json(["status"=>true,"messages"=>"data insert successfuly","data"=>[]]);
        }else{
              return respomse()->json(["status"=>false,"messages"=>"data insert failed","data"=>[]]);
        }

    }
    public function get_user(Request $request){
        $userList = Crud::all();
        return response()->json(["status"=>true,"messages"=>"","data"=>$userList]);
    }
    public function edit_user(Request $request){
        $editUser = Crud::where("_id",$request->id)->get();
        return response()->json(["status"=>true,"messages"=>"","data"=>$editUser]);
    }
    public function update_user(Request $request){
        $data = $request->all();
         /* for this function data validation to user */
         $validation = Validator::make($data,[ 
            'name' => 'required',
            'branch' => 'required',
            'designation' => 'required',
        ]);
          /* If data valid any one field that will be return the fail message*/
        if($validation->fails()){
            return $validation->errors()->first();   
        }
        $recordUpdate  =Crud::where("_id",$request->id)->update(["name"=>$request->name,"branch"=>$request->branch,"designation"=>$request->designation]); 
        if($recordUpdate){
             return response()->json(["status"=>true,"messages"=>"data updated successfuly","data"=>[]]);
        }else{
              return response()->json(["status"=>false,"messages"=>"data updated failed","data"=>[]]);
        }

    }
    public function delete_user(Request $request){
        $deleteUser = Crud::where("_id",$request->id)->delete();
        if($deleteUser){
            return response()->json(["status"=>true,"messages"=>"data deleted successfuly","data"=>[]]);
        }else{
             return response()->json(["status"=>false,"messages"=>"data delete failed","data"=>[]]);
        }
    }
}