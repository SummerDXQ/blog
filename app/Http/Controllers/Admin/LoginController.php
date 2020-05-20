<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

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
}
