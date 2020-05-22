<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Validator;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    //Login
    public function login(){
        return view('admin.login');
    }

    // Generate captcha
    public function captcha(Request $request){
        $builder = new CaptchaBuilder;
        // captcha size
        $builder->build(150,40);
        //captcha content
        $phrase = $builder->getPhrase();
        //store captcha into session
        $request->session()->flash('captchaSession', $phrase);
        //clear cache
        ob_clean();
        //output captcha in jpeg format
        return response($builder->output())->header('Content-type','image/jpeg');
    }

    public function doLogin(Request $request){
        // get data from form
        $input = $request->except('_token');
        $rule = [
            'username'=>'required|between:4,18',
            'password'=>'required|between:4,18|alpha_dash',
        ];
        $msg=[
            'username.required'=>"Username is require!",
            'username.between'=>"Username length is between 4 to 18!",
            'password.required'=>"Password is require!",
            'password.between'=>"Password length is between 4 to 18!",
            'password.alpha_dash'=>"Password should be digit, letter or _!",
        ];
        // validate user input
        $validator = Validator::make($input,$rule,$msg);

        if ($validator->fails()) {
            return redirect('admin/login')
                    ->withErrors($validator)
                    ->withInput();
        }
        // validate captcha
        if(strtolower($input['captcha']) != strtolower(session()->get('captchaSession'))){
            return redirect('/admin/login')->with('errors','验证码错误');
        }
        // connect database and validate user info
        $user = User::where('user_name',$input['username'])->first();
        if(!$user){
            return redirect('admin/login')->with('errors','用户名不正确');
        }
        if($input['password'] != Crypt::decrypt($user->user_pass)){
            return redirect('admin/login')->with('errors','密码不正确');
        }
        // store user info into session
        session()->put('user',$user);
        // redirect to home page
        return redirect('admin/index');
    }
    //Home page
    public function index(){
        return view('admin.index');
    }
    // welcome page
    public function welcome(){
        return view('admin.welcome');
    }
    // logout
    public function logout(){
        // clear session
        session()->flush();
        // redirect to login page
        return redirect('admin/login');
    }
    // no permission
    public function noaccess(){
        return view('errors.errors');
    }


//    public function jm(){
//        return Crypt::encrypt('123456');
////        return view('admin.welcome');
//    }
}
