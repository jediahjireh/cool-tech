<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // function to handle login form submission
    public function writerLogin(Request $request)
    {
        // ensure 'password' field is present and not empty
        $request->validate([
            'password' => 'required',
        ]);

        // check if the provided password matches the expected writer password
        if ($request->password === 'writer-password') {
            // store a session variable indicating the writer is logged in
            Session::put('is_writer_logged_in', true);
            // redirect to the writer console page upon successful login
            return redirect()->route('writer.console');
        }

        // redirect back to the login form with an error message if the password is invalid
        return redirect()->back()->withErrors(['password' => 'Invalid password!']);
    }


    // function to handle admin login form submission
    public function adminLogin(Request $request)
    {
        // ensure 'password' field is present and not empty
        $request->validate([
            'password' => 'required',
        ]);

        // check if the provided password matches the expected admin password
        if ($request->password === 'admin-password') {
            // store a session variable indicating the admin is logged in
            Session::put('is_admin_logged_in', true);
            // redirect to the admin console page upon successful login
            return redirect()->route('admin.console');
        }

        // redirect back to the login form with an error message if the password is invalid
        return redirect()->back()->withErrors(['password' => 'Invalid password!']);
    }
}
