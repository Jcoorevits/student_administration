@extends('layouts.student_administration')
@section('title', 'Programme')
@section('main')
    <div class="mt-3"><h1>{{$programme->name}}</h1>
        @if(count($courses) == 0)
            <div class="alert alert-danger alert-dismissible fade show">
                No courses for this programme!
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @else
            <p>Courses:</p>
            <ul>
                @foreach($courses as $course)
                    <li>{{$course->name}}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
