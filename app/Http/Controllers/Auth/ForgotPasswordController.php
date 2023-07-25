<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralFunctionsController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Seshac\Otp\Otp;
use Seshac\Otp\Models\Otp as OtpModel;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Environment\Console;
//use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;
    public function postforgot(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
        ]);
        $email = $request->get('email');

        $db = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => Carbon::now()
        ]);
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        $identifier = $email;
        $otp =  Otp::setValidity(30)  // otp validity time in mins
            ->setLength(4)  // Lenght of the generated otp
            ->setMaximumOtpsAllowed(10) // Number of times allowed to regenerate otps
            ->setOnlyDigits(false)  // generated otp contains mixed characters ex:ad2312
            ->setUseSameToken(true) // if you re-generate OTP, you will get same token
            ->generate($identifier);
        $otp_token = $otp->token;
        $details = [
            'title' => 'Mail from Digital Rx',
            'body' => $otp_token . ' is the OTP For Reset Password'
        ];

        // Mail::raw($details, function ($message,$email) {
        //     $message->from('sunpharma@gmail.com', 'Digital RX');
        //     $message->to($email);
        //     $message->subject('OTP From digital RX');
        // });

        Mail::to($email)->send(new \App\Mail\MyMail($details));
        // if (Mail::failures()) {
        //     // return response showing failed emails
        //     Session::flash('error', 'Something went Wrong');
        //     return \Redirect::back();
        // }
        // else{
        //     dd("else..");
        // }

        return view('auth.passwords.otp', compact('otp_token', 'identifier', 'tokenData'));
    }
    public function postotp(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'otp_value' => 'required',
        ]);
        //check if payload is valid before moving on
        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
            //  return redirect()->back()->withErrors([$validator]);
        }
        $otp_token = $request->get('otp_token');
        $identifier = $request->get('identifier');
        $token = $request->get('token');
        $otp = $request->get('otp_value');;
        $otp = Otp::validate($identifier, $otp);
        if ($otp->status == true) {
            //   Session::flash('success', 'OTP Is Valid!');
            return view('auth.passwords.reset', compact('token'));
        } else {
            $tokenData = DB::table('password_resets')
                ->where('email', $identifier)->first();
            // session()->flash('error','OTP is not Valid');
            Session::flash('error', 'OTP is not Valid');
            return \Redirect::back();
        }
    }

    public function resetPassword(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            //|email|exists:users,email
            //'email' => 'required',
            'password' => 'required|confirmed',
            'token' => 'required'
        ]);

        //check if payload is valid before moving on
        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        }

        $password = $request->password;
        // Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.passwords.email');
        $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
        //Hash and update the new password
        $user->password = Hash::make($password);
        $user->update(); //or $user->save();
        //login the user immediately they change password successfully
        Auth::login($user);
        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();
        //Send Email Reset Success Email
        $user_type=$user->user_type;
        $user_id=$user->id;
        if ($user_type == "ff") {
            $brand_id=0;
            $object = new GeneralFunctionsController();
            $datas = [
                'user_id' => $user_id,
                'brand_id' => $brand_id,
                'start_date' => "",
                'end_date' => ""
            ];
            // $user_id,$brand_id
            $returnData = $object->get_dashboard_details($datas);
            return view('home', $returnData);
        } else {
            return redirect()->route("home");
        }

     //   return view('/home');
    }


    //
}
