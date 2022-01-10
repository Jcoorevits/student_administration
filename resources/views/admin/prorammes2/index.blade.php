@extends('layouts.student_administration')

@section('title', 'Programmes Ajax')

@section('main')
    <div class="mt-3">
        <h1>Programmes</h1>
        @include('shared.alert')
        <a href="/admin/programmes/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Create new programme
        </a>
        <ul class="lbody list-group mt-3">
        </ul>
    </div>


@endsection


@section('script_after')
    <script>
        loadPage();

        // Popup a dialog
        $('.lbody').on('click', '.btn-delete', function () {
            // Get data attributes from td tag
            const id = $(this).closest('a').data('id');
            const name = $(this).closest('a').data('name');
            const programme = $(this).closest('a').data('course');
            // Set some values for Noty
            let text = `<p>Delete the programme <b>${name}</b>?</p>`;
            let type = 'warning';
            let btnText = 'Delete genre';
            let btnClass = 'btn-success';
            // If records not 0, overwrite values for Noty
            if (programme > 0) {
                text += `<p>ATTENTION: you are going to delete ${programme} records at the same time!</p>`;
                btnText = `Delete genre + ${programme} records`;
                btnClass = 'btn-danger';
                type = 'error';
            }
            // Show Confirm Dialog
            let modal = new Noty({
                type: type,
                text: text,
                buttons: [
                    Noty.button(btnText, `btn ${btnClass}`, function () {
                        // Delete genre and close modal
                        deleteGenre(id);
                        modal.close();
                    }),
                    Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                        modal.close();
                    })
                ]
            }).show();
        });

        // Delete a genre
        function deleteGenre(id) {
            // Delete the genre from the database
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete'
            };
            $.post(`/admin/programmes2/${id}`, pars, 'json')
                .done(function (data) {
                    console.log('data', data);
                    // Show toast
                    new Noty({
                        type: data.type,
                        text: data.text,
                        // overwrite default Noty settings
                        layout: 'topRight',
                        timeout: 3000,
                        modal: false,
                    }).show();
                    // Rebuild the table
                    loadPage();
                })
                .fail(function (e) {
                    console.log('error', e);
                });
        }

        function loadPage() {
            $.getJSON('/admin/programmes2/qryProgrammes')
                .done(function (data) {
                    console.log('data', data)
                    $('.lbody').empty();
                    $.each(data, function (key, value) {
                        let li = `<li class="list-group-item text-primary">
                    <div class="row justify-content-between m-1">
                        <div class=""><a class="text-decoration-none"
                                         href="/admin/programmes/${value.id}">${value.name}</a></div>
                        <div class="btn-group btn-group-sm">
                            <a href="#!" class="btn btn-outline-success btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            <a href="#!" class="btn btn-outline-danger btn-delete"
                                data-course="${value.courses_count}"
                                data-name="${value.name}" data-id="${value.id}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                    </div>
                </li>`;
                        $('.lbody').append(li)

                    })
                })
                .fail(function (e) {
                    console.log('error', e)
                })
        }

    </script>



@endsection
