<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME')}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Optional theme -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    {{--    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">--}}
    @toastr_css
    <style>
        body{
            background: #FDFCFC !important;
        }
        .student_container{
            display:grid;
            grid-template-columns: repeat(5 , 1fr);

        }

        .student_container  .user_profile {
            text-align: center;
        }
      , .assign_course_btn{
            display:flex;
            justify-content: flex-end;
            margin-bottom: 20px;

        }
        .assign_course_btn button:first-child {
            color:white;
            background: #DC6513;
            padding:10px;
            border: 1px solid #DC6513;
            border-radius: 4px;
            margin:5px;
        }
        .assign_course_btn button:hover:first-child {
            color:white;
            background:  #021037;
            padding:10px;
            border: 1px solid #DC6513;
            border-radius: 4px;
            margin:5px;
        }
        .un-assign_course_btn a{
            color:white;
            background: #DC6513;
            text-decoration: none;
            border: 1px solid #DC6513;
            border-radius: 4px;
            margin:5px;
        }

        .un-assign_course_btn a:hover{
            color:white;
            background:  #021037;
            text-decoration: none;
            border: 1px solid #DC6513;
            border-radius: 4px;
            margin:5px;
            padding:5px;
        }
        .user_profile{
            grid-column: 1/2;
        }
        .courses_table{
            grid-column: 3/5;
        }
        .invalid-feedback{
            color:red;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">School Management App Test</h4>
        <hr>
    </div>


    <div class="student_container">
        <div class="user_profile">
            <img src="{{asset('icons/user.png')}}"/>
            <div class="profile_info">
                <h4>{{$user->full_name}}</h4>
                <h5>{{$user->email}}</h5>
            </div>
            <div>
                <form method="POST" action="{{url('assign/'.$user->id.'/course')}}">
                    @csrf
                    <label for="assign_course">Assign Course</label>
                  <div class="form-group">
                      <select class="form-control"  name="course_id" >
                          <option> Select Course </option>
                          @foreach($courses as $course)
                              <option value="{{$course->id}}">{{$course->name}}</option>
                          @endforeach
                      </select>
                      @error('course_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                      @enderror
                  </div>
                    <div class="assign_course_btn form-group">
                        <button>Assign Course</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="courses_table">
            <h3>List Of Courses</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Acton</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->courses as $course)
                    <tr>
                        <td>{{$course->name}}</td>
                        <td>
                            <div class="un-assign_course_btn">
                                <a href="{{url('/detach/'.$user->id. '/course/'.$course->id)}}" class="btn btn-sm">Un-assign Course</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>


</div>
</body>
@jquery
@toastr_js
@toastr_render
</html>
