<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            "email"     => ["required", "email"],
            "password"  => ["required"],
        ]);

        $credentials = $request->only("email", "password");

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            $agent = new Agent();

            //begin::Loglama
            $userId = auth()->user()->id;
            $ipAddress = $request->ip();
            $currentTime = now();
            $device = $agent->platform();
            Log::info("Kullanıcı giriş yaptı - User ID: $userId, IP: $ipAddress, Tarih: $currentTime");
            LoginLogs::create([
                'user_id' => $userId,
                'device' => $device,
                'ip' => $ipAddress,
                'last_login' => $currentTime,
            ]);
            //end::Loglama

            return redirect()->intended(route("admin.dashboard"));
        }

        return back()->withErrors([
            "email" => "Girilen Bilgiler Hatalıdır",
        ]);
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route("login");
    }
}
