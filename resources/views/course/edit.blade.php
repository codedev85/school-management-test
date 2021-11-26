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

    <style>
        body{
            background: #FDFCFC !important;
        }
        .student_container{
            display:grid;
            grid-template-columns: repeat(5, 1fr);

        }
        .form_box{
            background: #021037;
            padding:100px;
            color:#fff;
            grid-column: 2/5;
            border-radius: 20px;
        }
        .add_student{
            text-align: center;
        }
        .add_student button {
            color:white;
            background: #DC6513;
            padding:10px;
            border: 1px solid #DC6513;
            border-radius: 4px;
            margin-top: 20px;
        }
        .add_student button:hover {
            color:white;
            background: #021037;
            padding:7px;
            border: 1px solid #DC6513;
            border-radius: 4px;
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


    <div class="student_container">
        <div class="form_box">
            <form method="POST" action="{{url('courses/'.$course->id)}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="full_name">Course Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name')is-invalid @enderror" value="{{$course->name}}"  required/>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="add_student">
                    <button>Update Course</button>
                </div>
            </form>
        </div>

    </div>


</div>
</body>
</html>
