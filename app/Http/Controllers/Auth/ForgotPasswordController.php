<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users']);

        $tokenCreatedAt = Carbon::now();

        $tokenExpiration = $tokenCreatedAt->copy()->addHours(1);

        $token = Str::random(64);

        $existingRecord = DB::table("password_reset_tokens")
            ->where('email', $request->email)
            ->first();

        if ($existingRecord){
            DB::table("password_reset_tokens")
                ->where("email", $request->email)
                ->update([
                    "token" => $token,
                    "updated_at" => $tokenCreatedAt,
                    "expires_at" => $tokenExpiration
                ]);
        }else{
            DB::table("password_reset_tokens")->insert([
                "email" => $request->email,
                "token" =>  $token,
                "created_at" => $tokenCreatedAt,
                "expires_at" => $tokenExpiration
            ]);
        }

        Mail::send("emails.forgot-password", ["token" => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject("Réinitialisation de Mot de Passe");
        });

        return to_route("login")->with("success", "Adresinize şifre sıfırlama e-postası gönderildi. Bu bilgiyi yeni bir şifre oluşturmak için kullanabilirsiniz.");
    }
}
