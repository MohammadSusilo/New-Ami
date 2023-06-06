<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // baru


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function proses_login(Request $request)
    {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        dd($credentials);
        if (Auth::attempt($credentials)) {
            $status = auth()->user()->status;
            // $user = Auth::user();
            if($status == 1){
                $roles = auth()->user()->role_id;

                if ($roles == 1) {
                    return redirect()->route('admin.home');
                }elseif ($roles == 2) {
                    return redirect()->route('auditor.home');
                }elseif ($roles == 3) {
                    return redirect()->route('auditee.home');
                }else{
                    session()->flush();
                    return redirect()->route('login')
                    ->with('error','Email-Address And Password Are Wrong.');
                }
            }else{
                session()->flush();
                return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
            }
            // return redirect('/');
        }
        return redirect('login')->withSuccess('Oppes! Silahkan Cek Inputanmu');
    }
    public function logout(Request $request) {
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}