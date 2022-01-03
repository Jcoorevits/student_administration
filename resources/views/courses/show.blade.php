@extends("layouts.student_administration")

@section("title", "Welcome to the Student Administration")

@section("main")
    <div class="mt-3">
        @foreach($courses as $course)

            <h1>{{$course->name}}</h1>
            <p>{{$course->description}}</p>

            @if ($course->studentcourses->count() == 0)
                <div class="alert alert-danger alert-dismissible fade show">
                    No students enrolled!
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>

            @else
                <p>List of students enrolled:</p>
                <ul>
                    @foreach($course->studentcourses as $students)
                        <li>{{$students->student->first_name}} {{$students->student->last_name}}
                            (semester {{$students->semester}})
                        </li>
                    @endforeach
                </ul>
            @endif

        @endforeach

    </div>
@endsection
