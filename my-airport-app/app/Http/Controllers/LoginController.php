<?php

namespace App\Http\Controllers\Auth;  

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;  
use Illuminate\Foundation\Auth\AuthenticatesUsers;  

class LoginController extends Controller  
{  
    use AuthenticatesUsers;  
    
    
    protected function sendLoginResponse(Request $request)  
    {  
        $request->session()->regenerate();  

        // Redirect intended or to /homepage  
        return redirect()->intended('/homepage');  
    }  
}  