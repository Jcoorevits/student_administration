@extends("layouts.student_administration")

@section("title", "Welcome to the Student Administration")

@section("main")
    <h1>Courses</h1>
    <p>You selected the course with id:{{$id}}</p>
    <p>List of students enrolled</p>
@endsection
