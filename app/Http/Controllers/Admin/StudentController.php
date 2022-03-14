<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentValidationRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\ResponseStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use ResponseStatusTrait;

    public function index()
    {
        $data['pageTitle'] = "Student List";
        $data['navStudentActiveCLass'] = 'hover show';
        $data['subNavStudentActiveCLass'] = 'active';
        $data['students'] = User::withCount('studentCourses')->paginate();

        return view('admin.student.list')->with($data);
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
    public function store(StudentValidationRequest $request)
    {
        $request->validated();
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->registration_no = 1001 + User::count();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Student Created Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['pageTitle'] = "Student List";
        $data['navStudentActiveCLass'] = 'hover show';
        $data['subNavStudentActiveCLass'] = 'active';
        $data['student'] = User::with('studentCourses')->withCount('studentCourses')->findOrFail($id);
        $data['transactions'] = Transaction::whereUserId(Auth::user()->id)->get();

        return view('admin.student.view')->with($data);
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
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Student Updated Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'Deleted Successful');
    }

    public function getEmail(Request $request)
    {
        $student = User::whereEmail($request->email)->first();
        if ($student)
        {
            $response['student'] = 1;
        } else {
            $response['student'] = 0;
        }
        return $this->successApiResponse($response);
    }
}
