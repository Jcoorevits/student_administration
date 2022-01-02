@extends("layouts.student_administration")

@section("title", "Welcome to the Student Administration")

@section("main")
    <h1>Courses</h1>
    @include('courses.search')

    @if ($courses->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show col">
            Can't find any Courses {!! $filter !!} in {!! $programme !!}.
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif
    <div class="row ">
        @foreach($courses as $course)
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 p-0 m-0 mb-3 row justify-content-center">
                <div class="card m-3">
                    <div class="card-body row m-0">
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <p class="card-text">{{$course['description']}}</p>
                        <p class="card-text text-primary text-uppercase">{{$course->programme->name}}</p>
                    </div>
                    @auth()
                    <div class="card-footer d-flex justify-content-between">
                        <a href="courses/{{ $course->id }}"
                           class="btn btn-outline-info btn btn-primary btn-block text-light">Manage Students</a>

                    </div>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('script_after'){{-- Werkt niet--}}
<script>
    $('#filterSelect').change(function () {
        $(this).parents("form").submit();
    })
</script>
@endsection
