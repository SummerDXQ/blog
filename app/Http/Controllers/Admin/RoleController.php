<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    // grant rights
    public function auth($id){
        // get current role
        $role = Role::find($id);
        // get permission list
        $perms = Permission::get();
        //get current role's permission
        $own_perms = $role->permission;
        // get permission id
        $arr_perms = [];
        foreach ($own_perms as $v){
            $arr_perms[] = $v->id;
        }
        return view('admin.role.auth',['role'=>$role,'perms'=>$perms,'arr_perms'=>$arr_perms]);
    }
    // edit right
    public function doAuth(Request $request){
        $input = $request->input();
        // filter rights
        \DB::table('role_permission')->where('role_id',$input['role_id'])->delete();
        // add new rights
        if(!empty($input['permission_id'])){
            foreach ($input['permission_id'] as $v){
                \DB::table('role_permission')->insert(['role_id'=>$input['role_id'],'permission_id'=>$v]);
            }
        }
        return redirect('admin/role');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get role list
        $role = Role::get();
        return view('admin.role.list',['role'=>$role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get data from form
        $input = $request->except('_token');
        // validate data
        // add data to database
        $res = Role::create($input);
        if($res){
            return redirect('admin/role');
        }else{
            return back()->with('msg','Add fail!');
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
