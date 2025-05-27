<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request; // Import the Request class

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function login(Request $request)
    {
        $credentials = [
            'admin123' => '@dmin',
            'staff123' => 'st@ff',
        ];
    
        $username = $request->input('username');
        $password = $request->input('password');
    
        if (isset($credentials[$username]) && $credentials[$username] === $password) {
            session(['username' => $username]); 
            return redirect()->route('home'); 
        }
    
        return redirect()->route('log')->with('error', 'Invalid username or password.'); 
    }
}