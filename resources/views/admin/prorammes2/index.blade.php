@extends('layouts.student_administration')

@section('title', 'Programmes Ajax')

@section('main')
    <div class="mt-3">
        <h1>Programmes</h1>
        @include('shared.alert')
        <button id="btn-create"  class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Create new programme
        </button>
        <ul class="lbody list-group mt-3">
        </ul>
    </div>
    @include('admin.prorammes2.modal')

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

        // Show the Bootstrap modal to edit a genre
        $('.lbody').on('click', '.btn-edit', function () {
            // Get data attributes from td tag
            const id = $(this).closest('a').data('id');
            const name = $(this).closest('a').data('name');
            // Update the modal
            $('.modal-title').text(`Edit ${name}`);
            $('form').attr('action', `/admin/programmes2/${id}`);
            $('#name').val(name);
            $('input[name="_method"]').val('put');
            // Show the modal
            $('#modal-programme').modal('show');
        });

        // Submit the Bootstrap modal form with AJAX
        $('#modal-programme form').submit(function (e) {
            // Don't submit the form
            e.preventDefault();
            // Get the action property (the URL to submit)
            const action = $(this).attr('action');
            // Serialize the form and send it as a parameter with the post
            const pars = $(this).serialize();
            console.log(pars);
            // Post the data to the URL
            $.post(action, pars, 'json')
                .done(function (data) {
                    console.log(data);
                    // show success message
                    Student_Administration.toast({
                        type: data.type,
                        text: data.text
                    });
                    // Hide the modal
                    $('#modal-programme').modal('hide');
                    // Rebuild the table
                    loadPage();
                })
                .fail(function (e) {
                    console.log('error', e);
                    // e.responseJSON.errors contains an array of all the validation errors
                    console.log('error message', e.responseJSON.errors);
                    // Loop over the e.responseJSON.errors array and create an ul list with all the error messages
                    let msg = '<ul>';
                    $.each(e.responseJSON.errors, function (key, value) {
                        msg += `<li>${value}</li>`;
                    });
                    msg += '</ul>';
                    // show the errors
                    Student_Administration.toast({
                        type: 'error',
                        text: msg
                    });
                });
        });

        // Show the Bootstrap modal to create a new programme
        $('#btn-create').click(function () {
            // Update the modal
            $('.modal-title').text(`New Programme`);
            $('form').attr('action', `/admin/programmes2`);
            $('#name').val('');
            $('input[name="_method"]').val('post');
            // Show the modal
            $('#modal-programme').modal('show');
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
                    // Show toast
                    Student_Administration.toast({
                        type: data.type,    // optional because the default type is 'success'
                        text: data.text,
                    });
                    // Rebuild the table
                    loadPage();
                })
                .fail(function (e) {
                    console.log('error', e);
                });
        }

        function initTooltip() {
            $('body').tooltip({
                selector: '[data-toggle="tooltip"]',
                html: true,
            }).on('click', '[data-toggle="tooltip"]', function () {
                // hide tooltip when you click on it
                console.log('Hi Mom!');
                $(this).tooltip('hide');
            });

        }


        function loadPage() {

            $.getJSON('/admin/programmes2/qryProgrammes')

                .done(function (data) {
                    initTooltip();
                    console.log('data', data)

                    $('.lbody').empty();


                    $.each(data, function (key, value) {

                        let li = `<li class="list-group-item text-primary">
                    <div class="row justify-content-between m-1">
                        <div class=""><a class="text-decoration-none"
                                         href="/admin/programmes/${value.id}">${value.name}</a></div>
                        <div class="btn-group btn-group-sm">
                            <a href="#!" class="btn btn-outline-success btn-edit"
                                data-course="${value.courses_count}"
                                data-toggle="tooltip"
                                   title="edit"
                                data-name="${value.name}" data-id="${value.id}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            <a href="#!" class="btn btn-outline-danger btn-delete"
                                data-course="${value.courses_count}"
                                title="delete"
                                data-toggle="tooltip"
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
