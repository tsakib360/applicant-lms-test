<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseValidationRequest;
use App\Models\Course;
use App\Models\User;
use App\Traits\ResponseStatusTrait;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ResponseStatusTrait;
    public function index()
    {
        $data['pageTitle'] = "Course List";
        $data['navCourseActiveCLass'] = 'hover show';
        $data['subNavCourseActiveCLass'] = 'active';
        $data['courses'] = Course::withCount('studentCourses')->paginate();

        return view('admin.course.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseValidationRequest $request)
    {
        $request->validated();

        $course = new Course();
        $course->name = $request->name;
        $course->code = $request->code;
        $course->price = $request->price;
        $course->save();

        return redirect()->back()->with('success', 'Course Created Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['navCourseActiveCLass'] = 'hover show';
        $data['subNavCourseActiveCLass'] = 'active';
        $data['course'] = Course::with('studentCourses')->withCount('studentCourses')->find($id);
        $data['pageTitle'] = $data['course']->name;
        $data['students'] = User::all();
//        dd($data['course']);

        return view('admin.course.view')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->back()->with('success', 'Course Deleted Successful');
    }


    public function getCode(Request $request)
    {
        $course = Course::whereCode($request->code)->first();
        if ($course)
        {
            $response['course'] = 1;
        } else {
            $response['course'] = 0;
        }
        return $this->successApiResponse($response);
    }
}
