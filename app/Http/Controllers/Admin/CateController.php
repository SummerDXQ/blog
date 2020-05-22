<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get category list
        $cates = (new Cate())->tree();
//        return $cates;
        return view('admin.cate.list',['cates'=>$cates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get first category
        $cate = Cate::where('cate_pid',0)->get();
        return view('admin.cate.add',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // receive adding category
        $input = $request->except('_token');
        // validate data
        // store data into database
        $res = Cate::create($input);
        if($res){
            return redirect('admin/cate');
        }else{
            return back();
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

    //change order
    public function changeOrder(Request $request){
        $input = $request->except('_token');
        // get current category
        $cate = Cate::find($input['cate_id']);
        // update order
        $res = $cate->update(['cate_order'=>$input['cate_order']]);
//        return(json_encode($res));
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'Update Successfully!'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'Update Fail!'
            ];
        }
        return $data;
    }
}
