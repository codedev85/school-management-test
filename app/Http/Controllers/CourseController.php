<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('course.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
        ]);

        $course = new Course();
        $course->create($data);

        toastr()->success('Course created successfully');

        return redirect('/courses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $students = \App\Models\Student::all();

        $course = Course::where('id',$course->id)->with('students')->first();

        return view('course.show',compact('course','students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return  view('course.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $data  = request()->validate([
            'name' => 'required',
        ]);

        Course::where('id', $course->id)
            ->update(['name' => $data['name']]);

        toastr()->success('Course updated successfully');

        return redirect('/courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $student = Course::find($course->id);
        $student->delete();

        toastr()->success('Course deleted successfully');

        return redirect('/courses');
    }

    public function assignCourse(Request $request , $course_id)
    {

        $data  =  request()->validate([
            'student_id' => 'required|integer'
        ]);

        $course = Course::where('id',$course_id)->firstorfail();

        $isAttached =  $course->students()->syncWithoutDetaching($data['student_id']);

        if(empty($isAttached['attached']))
        {
            toastr()->error('Course already  assigned to the user');
        }else{
            toastr()->success('Course assigned successfully');
        }

        return back();

    }

    public function unassignCourse($student_id , $course_id)
    {
        $student = Student::where('id',$student_id)->firstorfail();

        $student->courses()->detach($course_id);

        toastr()->success('Course removed successfully');

        return back();
    }

}
