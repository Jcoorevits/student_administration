@extends('layouts.student_administration')
@section('title', 'Programmes')
@section('main')

    <div class="mt-3">
        <h1>Programmes</h1>
        @include('shared.alert')
        <a href="/admin/programmes/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Create new programme
        </a>

        <ul class="list-group mt-3">
            @foreach($programmes as $programme)
                <li class="list-group-item text-primary">
                    <div class="row justify-content-between m-1">
                        <div class=""><a class="text-decoration-none"
                                         href="/admin/programmes/{{$programme->id}}">{{$programme->name}}</a></div>
                        <form action="/admin/programmes/{{ $programme->id }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/programmes/{{ $programme->id }}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{ $programme->name }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                               {{-- @php
                                    $courseCount = 0
                                @endphp
                                @foreach($courses as $course)
                                    @if($course->programme_id == $programme->id)
                                        @php
                                            $courseCount +=1
                                        @endphp
                                    @endif
                                @endforeach
--}}
                                <button type="button" class="btn btn-outline-danger deleteProgramme"
                                        data-toggle="tooltip"
                                        id="{{ $programme->name }}"
                                        data-course="{{$programme->courses_count}}"
                                        title="Delete {{ $programme->name }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

    </div>
@endsection
@section('script_after')
    <script>
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]',
            html : true,
        }).on('click', '[data-toggle="tooltip"]', function () {
            // hide tooltip when you click on it
            $(this).tooltip('hide');
        });

        $('.deleteProgramme').each(function () {
            let msg = ""
            console.log($(this).data("course"))
            $(this).click(function () {
                if ($(this).data("course") > 0) {
                    msg = `Delete the programme '${this.id}'?\nThe ${$(this).data("course")} courses of this programme wil also be deleted!`;
                } else {
                    msg = `Delete the programme '${this.id}'?`;
                }
                if (confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })
        })
    </script>
@endsection

