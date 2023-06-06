<?php
  
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
  
use Closure;
   
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     if(auth()->check()){
    //         if(auth()->user()->role_id == 1){
    //             return $next($request);
    //         }
    //         if(auth()->user()->role_id == 2){
    //             return $next($request);
    //         }
    //         if(auth()->user()->role_id == 3){
    //             return $next($request);
    //         }
    //     }
        
    //     // return redirect('home')->with('error',"You don't have admin access.");
    //     // if (auth()->user()->is_admin == null){
    //     //     return redirect('home')->with('error',"You don't have admin access.");
    //     // }
    //     // return $next($request);

    //     // if(auth()->user()->is_admin == 1){
    //     //     return $next($request);
    //     // }
    //     // if(auth()->user()->is_admin == 2){
    //     //     return $next($request);
    //     // }
    //     // if(auth()->user()->is_admin == 3){
    //     //     return $next($request);
    //     // }
   
    //     // return redirect('home')->with('error',"You don't have admin access.");
    // }

    public function handle(Request $request, Closure $next, $roles)
    {
        // if(auth()->check()){
        //     if(auth()->user()->role_id == 1){
        //         return $next($request);
        //     }
        //     if(auth()->user()->role_id == 2){
        //         return $next($request);
        //     }
        //     if(auth()->user()->role_id == 3){
        //         return $next($request);
        //     }
        // }

        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // if($user->role_id == $roles)
        //     return $next($request);
        if($user->role_id == $roles){
            return $next($request);
        }
            
        // if(auth()->user()->role_id == 1){
        //     return $next($request);
        // }
        // if(auth()->user()->role_id == 2){
        //     return $next($request);
        // }
        // if(auth()->user()->role_id == 3){
        //     return $next($request);
        // }

        $request->session()->flush();
        Auth::logout();
        return redirect('login')->with('error',"kamu gak punya akses");
    }
}