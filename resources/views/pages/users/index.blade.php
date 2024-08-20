@extends('layouts.main')

@push('styles')
    <style>
        #modalUser .modal-dialog {
            max-width: 1000px;
        }
    </style>
@endpush

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush mb-5 mb-xl-10">
                    <div class="card-header">
                        <div class="card-title col d-flex justify-content-between ">
                            <h2 class="mb-0">Users</h2>
                            <div class="col"></div>
                            <div class="col-3 mx-3">
                                <input type="text" class="form-control form-control-solid " id="search"
                                       placeholder="Search"/>
                            </div>
                            <div class="d-flex">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-create">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-9 pb-0">
                        <table class="table table-row-dashed table-row-gray-300 gy-7" id="table-users">
                            <thead>
                            <tr>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalUser">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" id="modalUserHeader">
                    <h2 class="fw-bolder">Create User</h2>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                 fill="none">
                                <path
                                    d="M18.364 5.636a.5.5 0 00-.707 0L12 10.293 6.343 4.636a.5.5 0 00-.707.707L11.293 11l-5.65 5.657a.5.5 0 00.707.707L12 11.707l5.657 5.657a.5.5 0 00.707-.707L12.707 11l5.657-5.657a.5.5 0 000-.707z"
                                    fill="#000000"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <form id="formUser" method="post">
                    @csrf
                    <input id="id" name="id" value="" type="hidden">
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-10 col">
                                <label for="name" class="form-label required">Name</label>
                                <input type="text" class="form-control form-control-solid" id="name" name="name"/>
                                <div class="text-danger name_error"></div>
                            </div>
                            <div class="mb-10 col">
                                <label for="email" class="form-label required">Email</label>
                                <input type="email" class="form-control form-control-solid" id="email" name="email"/>
                                <div class="text-danger email_error"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-10 col">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" class="form-control form-control-solid" id="avatar" name="avatar"/>
                                <div class="text-danger avatar_error"></div>
                            </div>
                            <div class="mb-10 col">
                                <label for="old_image" class="form-label"> </label> <br>
                                <img width="60px" src="{{ asset('theme/assets/media/svg/avatars/blank.svg') }}" id="old_image" class="img-fluid" alt="old image"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-10">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-solid" id="password" name="password"/>
                                <div class="text-danger password_error"></div>
                            </div>
                            <div class="col mb-10">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control form-control-solid" id="phone" name="phone"/>
                            </div>

                        </div>
                        <div class="row">
{{--                            <div class="col mb-10">--}}
{{--                                <label for="access" class="form-label">Access</label>--}}
{{--                                <select class="form-select form-select-solid" id="access" name="access">--}}
{{--                                    <option value="admin">Admin</option>--}}
{{--                                    <option value="user">User</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="col mb-10">
                                <label for="roles" class="form-label">Roles</label>
                                <select class="form-select form-select-solid" id="roles" name="roles[]" multiple>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-10">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select form-select-solid" id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            //select2
            $('#roles').select2({
                placeholder: 'Select roles',
                allowClear: true
            });


            $('#check_all_permissions').click(function () {
                if ($(this).is(':checked')) {
                    $('input[type=checkbox]').prop('checked', true);
                } else {
                    $('input[type=checkbox]').prop('checked', false);
                }
            });

            var table = $('#table-users').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('get.users') }}",
                    data: function (d) {
                        d.search.value = $('#search').val();
                    }
                },
                columns: [
                    {data: 'avatar', name: 'avatar', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'roles', name: 'roles'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                searching: false,
                sorting: false,
            });

            $('.btn-create').click(function () {
                $('#formUser')[0].reset();
                $('#id').val('');
                $('#old_image').attr('src', '{{ asset('theme/assets/media/svg/avatars/blank.svg') }}');
                $('#modalUser').modal('show');
                //reset select2
                $('#roles').val(null).trigger('change');
                $('#modalUserHeader h2').text('Create User');
            });
            $('#search').on('keyup', function () {
                var value = this.value;
                table.search(value).draw();
            });
            $('body').on('click', '.btn-edit', function () {
                const id = $(this).data('id');
                const url = "{{ route('users.edit', ':id') }}".replace(':id', id);
                $.ajax({
                    url: url,
                    data: {id: id},
                    success: function (response) {


                        //reset form
                        $('#formUser')[0].reset();
                        $('#id').val(response.data.id);
                        $('#name').val(response.data.name);
                        $('#email').val(response.data.email);
                        $('#phone').val(response.data.phone);
                        $('#status').val(response.data.status).trigger('change');

                        if(response.data.avatar == null){
                            $('#old_image').attr('src', '{{ asset('theme/assets/media/svg/avatars/blank.svg') }}');
                        }else{
                            $('#old_image').attr('src', response.data.avatar);
                        }
                        $('#password').val('');
                        $('#roles').val(response.data.roles.map(role => role.id)).trigger('change');
                        $('#modalUser').modal('show');
                        $('#modalUserHeader h2').text('Edit User');

                    }
                });
            });
            $('body').on('click', '.btn-delete', function () {
                const id = $(this).data('id');
                const url = "{{ route('users.destroy', ':id') }}".replace(':id', id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    ).then(function () {
                                        toastr.success(response.message);
                                        $('#table-users').DataTable().ajax.reload();
                                    });
                                }
                            }
                        });
                    }
                });
            });

            $('#formUser').submit(function (e) {
                e.preventDefault();
                const id = $('#id').val();
                let url = id ? "{{ route('users.update', ':id') }}" : "{{ route('users.store') }}";
                url = url.replace(':id', id);
                const method = id ? 'patch' : 'POST';
                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            //sweet alert
                            $('#modalUser').modal('hide');
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(function () {
                                toastr.success(response.message);
                                $('#formUser')[0].reset();
                                $('#table-users').DataTable().ajax.reload();
                            });
                        } else {
                            toastr.error(response.message);
                            $.each(response.message, function (key, value) {
                                $('.' + key + '_error').text(value);
                            });
                        }
                    },
                    error: function (xhr) {
                        $('.error-text').empty();
                        toastr.error('Validation error. Please check your input again.');
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.' + key + '_error').text(value);
                        });
                    }

                });
            });
        });
    </script>
@endpush
