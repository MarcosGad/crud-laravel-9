<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    
    public function index()
    {
        $data = Student::latest()->paginate(5);

        return view('index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    
    public function create()
    {
        return view('create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'student_name'          =>  'required',
            'student_email'         =>  'required|email|unique:students',
            'student_image'         =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        $file_name = time() . '.' . request()->student_image->getClientOriginalExtension();

        request()->student_image->move(public_path('images'), $file_name);

        $student = new Student;

        $student->student_name = $request->student_name;
        $student->student_email = $request->student_email;
        $student->student_gender = $request->student_gender;
        $student->student_image = $file_name;

        $student->save();

        return redirect()->route('students.index')->with('success', 'Student Added successfully.');
    }

   
    public function show(Student $student)
    {
        return view('show', compact('student'));
    }

   
    public function edit(Student $student)
    {
        //
    }

    
    public function update(Request $request, Student $student)
    {
        //
    }

    
    public function destroy(Student $student)
    {
        //
    }
}
