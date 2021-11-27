<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     * @var Student $students
     *
     */
    public function index()
    {
        $students = Student::with('courses')->get();

        return view('student.index',compact('students'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */

    public function create()
    {
        return  view('student.create');
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
            'full_name' => 'required',
            'email' => 'required|email|unique:students'
        ]);

        /**
         * @var Student
         */

       $student = new Student();
       $student->create($data);

        toastr()->success('Student created successfully');

       return redirect('/students');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show(Student $student)
    {
        /**
         * @var Course $courses
         */
        $courses = Course::all();

        /**
         * @var Student $user
         */
        $user = Student::where('id',$student->id)->with('courses')->first();

        return view('student.show',compact('user','courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function edit(Student $student)
    {
        return  view('student.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $data  = request()->validate([
            'full_name' => 'required',
            'email' => 'required'
        ]);

        Student::where('id', $student->id)
                        ->update(['full_name' => $data['full_name'] , 'email' => $data['email']]);

        toastr()->success('Student data updated successfully');

        return redirect('/students');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        // delete
        /**
         * @var Student $student
         */
        $student = Student::find($student->id);
        $student->delete();

        toastr()->success('Student data deleted successfully');

        return redirect('/students');


    }

    /**
     * @param Request $request
     * @param Student $student_id
     * @return \Illuminate\Http\RedirectResponse
     */
 public function assignCourse(Request $request , $student_id)
 {
       $data  =  request()->validate([
             'course_id' => 'required|integer'
         ]);

      /**
      * @var Student $student
      */

      $student = Student::where('id',$student_id)->firstorfail();

     /**
      * @var $isAttached
      */

      $isAttached =  $student->courses()->syncWithoutDetaching($data['course_id']);

    if(empty($isAttached['attached']))
    {
        toastr()->error('Course already  assigned to the user');
    }else{
        toastr()->success('Course assigned successfully');
    }

     return back();

 }

    /**
     * @param $student_id
     * @param $course_id
     * @return \Illuminate\Http\RedirectResponse
     */

 public function unassignCourse($student_id , $course_id)
 {
     /**
      * @var Student $student
      */
     $student = Student::where('id',$student_id)->firstorfail();

     $student->courses()->detach($course_id);

     toastr()->success('Course removed successfully');

     return back();
 }


}
