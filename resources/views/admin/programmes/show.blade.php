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
        <form action="" method="Post">
            @csrf
            <div class="form-group">
                <div class="mt-3"><label for="name">Name</label>
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Name"
                           minlength="3"
                           required>
                </div>
                <div class="mt-3"><label for="description">Description</label>
                    <input type="text" name="description" id="description"
                           class="form-control @error('description') is-invalid @enderror"
                           placeholder="Description"
                           minlength="3"
                           required>
                </div>
                <div>
                    <input type="text" name="id" id="id"
                           value="{{$programme->id}}"
                           hidden>
                </div>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn-primary btn mt-3">
                    Submit
                </button>
            </div>


        </form>
    </div>
@endsection
