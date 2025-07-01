<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\UserStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Helpers\Cmail;

class AuthController extends Controller
{
    public function loginForm(Request $request){
        $data = [
            'pageTitle'=>'Login'
        ];
        return view('back.pages.auth.login', $data);
    }
    public function forgetForm(Request $request){
        $data = [
            'pageTitle'=>'Forget Password'
        ];
        return view('back.pages.auth.forget', $data);
    }

    // LOGIN HANDLER FUNCTION METHOD START
    public function loginHandler(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        if($fieldType == 'email'){
            $request->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:5'
            ],[
                'login_id.required' => 'Enter your email or username',
                'login_id.email' => 'Invalid email address',
                'login_id.exists' => 'No account found for this email'
            ]);
        }else{
            $request->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5'
            ],[
                'login_id.required' => 'Enter your email or username',
                'login_id.exists' => 'No account found for this username'
            ]);
        }
        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password,
        );
        
        if(Auth::attempt($creds)){
            // Check if account is inactive
            if( auth()->user()->status == UserStatus::Inactive ){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->with('fail', 'Your account is currently inactive. Please contact support at (support@xblog.com) for further assistance.');
            }

            // Check if account is pending mode
            if(auth()->user()->status == UserStatus::Pending){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->with('fail', 'Your account is pending approval. Please check your email for further instuction or contact support at (support@xblog.com) for assistance');
            }

            // Redirect to dashboard
            return redirect()->route('admin.dashboard');

        }else{
            return redirect()->route('admin.login')->withInput()->with('fail', 'Incorrect Password.');
        }
    }
    // LOGIN HANDLER FUNCTION METHOD END

    // FORGET PASSWORD HANDLER FUNCTION METHOD Start
    public function sendPasswordResetLink(Request $request){
        // validate the form
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ],[
            'email.required' => 'The :attribute is required',
            'email.email' => 'Invailid email address',
            'email.exists' => 'We can not find a user with this email address',
        ]);

        // Get user details
        $user = User::where('email', $request->email)->first();

        // Generate token
        $token = base64_encode(Str::random(64));

        // If there is an existing token
        $oldToken = DB::table('password_reset_tokens')->where('email', $user->email)->first();

        if( $oldToken ){
            // Update exiting token
            DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->update([
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }else{
            DB::table('password_reset_tokens')->insert([
                'email'=> $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        // Create clickable action link
        $actionLink = route('admin.reset_password_form', ['token'=>$token]);

        $data = array(
            'actionLink' => $actionLink,
            'user' => $user
        );

        $mail_body = view('email-templates.forget-template', $data)->render();

        $mailConfig = array(
            'recipient_address' => $user->email,
            'recipient_name' => $user->name,
            'subject' => 'Reset Password',
            'body' => $mail_body,
        );

        if( CMail::send($mailConfig) ){
            return redirect()->route('admin.forget')->with('success', 'We have sent a passwerd rest link to your mail');
        }else{
            return redirect()->route('admin.forget')->with('fail', 'Somthing went wrong. Reset password link not sent. Try again later');
        }
    }
    // FORGET PASSWORD HANDLER FUNCTION METHOD END

    // RESET PASSWORD HANDLER FUNCTION METHOD START
    public function resetForm(Request $request, $token = null){
        $isTokenExists = DB::table('password_reset_tokens')->where('token',$token)->first();

        if( !$isTokenExists ){
            return redirect()->route('admin.forget')->with('fail', 'Invalid token! Request another password reset link.');
        }else{
            //Check if token is not expired
            $difMins = Carbon::createFromFormat('Y-m-d H:i:s', $isTokenExists->created_at)->diffInMinutes(Carbon::now());

            if($difMins > 15){
                // If token older than 15 minutes
                return redirect()->route('admin.forget')->with('fail', 'This password reset link has been expired. Please request a new link');
            }
            $data = [
                'pageTitle' => 'Reset Password',
                'token' => $token
            ];

            return view('back.pages.auth.reset', $data);
        }

    }

    public function resetPasswordHandler(Request $request){
        // Validate the form
        $request->validate([
            'new_password' => 'required|min:5|required_with:new_password_confirmation|same:new_password_confirmation',
            'new_password_confirmation' => 'required'
        ]);

        $dbToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();
        
        // Get user details
        $user = User::where('email', $dbToken->email)->first();

        // Update Password
        User::where('email', $dbToken->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        // Send notification email to user email that contain new password
        $data = array(
            'user' => $user,
            'new_password' => $request->new_password
        );
        
        $mail_body = view('email-templates.password-changes-template', $data)->render();

        $mailConfig = array(
            'recipient_address' => $user->email,
            'recipient_name' => $user->name,
            'subject' => 'Password Changed',
            'body' => $mail_body
        );

        if( Cmail::send($mailConfig) ){
            //Delete token from db
            DB::table('password_reset_tokens')->where([
                'email' => $dbToken->email,
                'token' => $dbToken->token,
            ])->delete();

            return redirect()->route('admin.login')->with('success', 'Your password has been changed successfully');
        }else{
            return redirect()->route('admin.reset_password_form', ['token' => $dbToken->token])->with('fail', 'Something went wrong! Try again later.');
        }
    }
    // RESET PASSWORD HANDLER FUNCTION METHOD END
    
}
