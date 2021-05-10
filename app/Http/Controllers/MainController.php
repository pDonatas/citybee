<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showProfile()
    {
        return view('profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function showAdmin()
    {
        if (Auth::user()->role == 2) {
            return view('admin.index', [
                'user' => Auth::user()
            ]);
        } else {
            return redirect("/");
        }
    }
}
