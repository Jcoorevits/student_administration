@extends('layouts.student_administration')

@section('title', 'Create programme')

@section('main')
    <h1>Create new programme</h1>
    <form action="/admin/programmes" method="post">
        @include('admin.programmes.form')
    </form>
@endsection
