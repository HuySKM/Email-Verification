<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    public function show(Request $request)
    {
        //echo 1;die;
        redirect($this->redirectPath());
        return view('auth.verify');
    }


    public function verify(Request $request)
    {
        //print_r('id:'.$request->route('id'));
        //print_r('time:'.$request->input('expires'));
       // print_r('time:'.$request->input('signature'));
        if(time() > $request->input('expires') + 30*60){
            echo 'Link da het han';die;
        } else {
            echo 'Ban da dang ky thanh cong';die;
        }
        if ($request->route('id') == $request->user()->getKey()) {
            //$request->user()->markEmailAsVerfied();

        }

        return redirect($this->redirectPath());

    }

    public function resend(Request $request)
    {

        //$request->user()->sendEmailVerificationNottification();
        return back()->with('resend', true);
    }
}
