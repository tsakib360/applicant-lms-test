<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        $data['pageTitle'] = 'Home';
        $data['courses'] = Course::withCount('studentCourses')->get();
        return view('student.home')->with($data);
    }

    public function profile()
    {
        $data['pageTitle'] = 'My Profile';
        $data['student'] = User::with('studentCourses')->withCount('studentCourses')->findOrFail(Auth::user()->id);
        $data['transactions'] = Transaction::whereUserId(Auth::user()->id)->get();
        return view('student.profile')->with($data);
    }
}
