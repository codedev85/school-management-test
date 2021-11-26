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
            grid-template-columns: repeat(4 , 1fr);
            grid-gap: 20px;
        }
        .student_box{
            background: #021037;
            padding:20px;
            border:1px solid #FDFCFC;
            box-shadow: 1px 2px 1px 2px #FDFCFC;
            color:#fff;
            border-radius: 5px;
            text-align: center;
        }
        .student_box button , .delete_btn{
            color:white;
            background: #021037;
            padding:5px;
            border: 1px solid #DC6513;
            border-radius: 4px;
            margin-top: 20px;
        }
        .student_box button:hover , .delete_btn:hover{
            color:white;
            background: #DC6513;
            padding:7px;
            border: 1px solid #DC6513;
            border-radius: 4px;
        }

        .student_create_btn{
            display:flex;
            justify-content: flex-end;
            margin-bottom: 20px;

        }
        .student_create_btn button:first-child {
            color:white;
            background: #DC6513;
            padding:10px;
            border: 1px solid #DC6513;
            border-radius: 4px;
            margin:5px;
        }

    </style>
</head>
<body>
<div class="container">

    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Well done!</h4>
        <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
        <hr>
        <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
    </div>

    <div class="student_create_btn">

        <a href="{{url('/courses/create')}}">
            <button>Create Course</button>
        </a>

    </div>
    <div class="student_container">
        @foreach($courses as $course)
            <div class="student_box">
                <div>
                    <h5>{{$course->name}}</h5>
                </div>

                <div>
                    <h5>Course: 6</h5>
                </div>
                <div>
                    <a href="{{url('courses/'.$course->id)}}">
                       <button>View</button>
                    </a>
                    <a href="{{url('courses/'.$course->id.'/edit')}}">
                        <button >Edit </button>
                    </a>


                    <form action="{{ route('courses.destroy', $course->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input class="delete_btn" type="submit" value="Delete" />
                    </form>
                </div>
            </div>
        @endforeach
    </div>


</div>
</body>
@jquery
@toastr_js
@toastr_render
</html>