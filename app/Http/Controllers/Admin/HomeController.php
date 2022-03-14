<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\StudentCourse;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data['pageTitle'] = 'Home';
        $data['subNavDashboardActiveCLass'] = 'active';
        $data['total_students'] = User::count();
        $data['total_courses'] = Course::count();
        $data['total_student_courses'] = StudentCourse::count();
        $data['total_sales'] = Transaction::sum('amount');
        return view('admin.home')->with($data);
    }
}
