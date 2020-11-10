<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontPageController extends Controller
{
    public function index() {
        $user = Auth::user();

        if ($user) {
            // If user is logged in, redirect to the dashboard
            return redirect(route('dashboard'));
        }

        return view('welcome');
    }
}
