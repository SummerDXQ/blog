<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    // relate to table
    public $table = 'category';
    // primary key
    public $primaryKey = 'cate_id';
    // fileds that can be operated
    public $guarded = [];
    // do not need to add created_at and updated_at
    public $timestamps = false;
    // data formatter
    public function tree(){
        // get all categories
        $cates = $this->orderBy('cate_order','asc')->get();
        //format
        return $this->getTree($cates);
    }
    public function getTree($category){
        //order
        $order_arr = [];
        //get parent category
        foreach ($category as $k => $v){
            if($v->cate_pid == 0){
                $order_arr[] = $v;
                // get children category
                foreach ($category as $m => $n){
                    if($v->cate_id == $n->cate_pid){
                        // add indentation for children category
                        $n -> cate_name = '------'.$n -> cate_name;
                        $order_arr[] = $n;
                    }
                }
            }
        }
        return $order_arr;
    }
}
