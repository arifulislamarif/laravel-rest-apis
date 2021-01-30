<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return response()->json(['students' => $students], 200);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => "required|unique:students,name",
            'roll' => "required|numeric",
            'address' => "required",
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->roll = $request->roll;
        $student->address = $request->address;
        $student->save();

        return response()->json(['message' => 'Student Created Successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        if ($student) {
            return response()->json(['student' => $student], 200);
        }else{
            return response()->json(['message' => 'Something Went Wrong'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        if ($student) {
            return response()->json(['student' => $student], 200);
        }else{
            return response()->json(['message' => 'Something Went Wrong'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'name' => "required|unique:students,name,$student->id",
            'roll' => "required|numeric",
            'address' => "required",
        ]);

        $student->name = $request->name;
        $student->roll = $request->roll;
        $student->address = $request->address;
        $student->save();

        return response()->json(['message' => 'Student Updated Successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if($student){
            $student->delete();
        }

        return response()->json(['message' => 'Student Deleted Successfully'], 200);
    }
}
