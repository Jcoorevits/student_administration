@extends('layouts.student_administration')
@section('title', 'Programmes')
@section('main')
    <div class="mt-3">
        <h1>Programmes</h1>
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
                            <button type="button" class="btn btn-outline-danger deleteProgramme"
                                    data-toggle="tooltip"
                                    title="Delete {{ $programme->name }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

    </div>
@endsection
@section('script_after')
    <script>
        $('.deleteProgramme').click(function () {

            let msg = `Delete this programme?`;

            if (confirm(msg)) {
                $(this).closest('form').submit();
            }
        })
    </script>
@endsection

