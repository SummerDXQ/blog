<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Validator;

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
        print_r('111');
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
    }
}
