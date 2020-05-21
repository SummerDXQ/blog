<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display user list
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //get filter data
        $user = User::orderBy('user_id','asc')
            ->where(function ($query) use($request){
                $username = $request->input('username');
                $email = $request->input('email');
                if(!empty($username)){
                    $query->where('user_name','like','%'.$username.'%');
                }
                if(!empty($email)){
                    $query->where('email','like','%'.$email.'%');
                }
            })->paginate($request->input('num')?$request->input('num'):3);

        return view('admin.user.list',['user'=>$user,'request'=>$request]);
    }

    /**
     * Show the form for adding users
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a new user into database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get data from form
        $input = $request->all();
        // store into database
        $username = $input['email'];
        $pass = Crypt::encrypt($input['pass']);
        $res = User::create(['user_name'=>$username,'user_pass'=>$pass,'email'=>$input['email']]);
        if($res){
            $data = [
                'status'=>0,
                'message'=>'Add Successfully!'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'Add Fail!'
            ];
        }
        return $data;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //find the record that needs to be updated
        $user = User::find($id);
        //get username
        $username = $request -> input('user_name');
        $user->user_name = $username;
        $res = $user->save();
        if($res){
            $data = [
                'status'=>0,
                'message'=>'Update successfully!'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'Update fail!'
            ];
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $res = $user->delete();
        if($res){
            $data = [
                'status'=>0,
                'message'=>'Delete successfully!'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'Delete fail!'
            ];
        }
        return $data;
    }
    public function delAll(Request $request){
        $input = $request->input("uid");
        $res = User::destroy($input);
        if($res){
            $data = [
                'status'=>0,
                'message'=>'Delete successfully!'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'Delete fail!'
            ];
        }
        return $data;
    }
}
