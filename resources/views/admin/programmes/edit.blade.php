@extends('layouts.student_administration')
@section('title', 'Programmes')
@section('main')
    <div class="mt-3"><h1>Edit programme: {{$programme->name}}</h1>
        <form action="/admin/programmes/{{$programme->id}}" method="post">
            @method('put')
        @include('admin.programmes.form')
    </div>
@endsection
