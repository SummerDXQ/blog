<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use App\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    // Upload file
    public function upload(Request $request){

        $file = $request->file("file1");

        if($file->isValid()){
            // get original file's extension
            $ext = $file -> getClientOriginalExtension();
            // store files
            $path = $file->store(date('Ymd'));
            if(!$path){
                return response()->json(['ServerNo'=>'400','ResultData'=>'Upload Fail!']);
            }
            return response()->json(['ServerNo'=>'200','ResultData'=>$path]);
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // store all articles
//        $arts = [];
//        // use redis
//        $listkey = 'LIST:ARTICLE';   //store article id
//        $hashkey = 'HASH:ARTICLE';
//        if(\Redis::exists($listkey)){
//            $list = Redis::lrange($listkey,0,-1);
//            foreach ($list as $k=>$v){
//                $arts[] = \Redis::hGetall($hashkey.$v);
//            }
//        }else{
//            //get all articles from database
//            $arts = Article::get()->toArray();
//            //store article id in redis
//            foreach ($arts as $k=>$v){
//                \Redis::rpush($listkey,$v['art_id']);
//                \Redis::hMset($hashkey.$v['art_id'],$v);
//            }
//        }
        // get all categories
        $arts = Article::get()->toArray();
        return view('admin.article.list',['arts' => $arts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = (new Cate())->tree();
        return view('admin.article.add',['cates' => $cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
