@extends('layouts.main')

@push('styles')
    <style>
        #modalRole .modal-dialog {
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
                            <h2 class="mb-0">Roles</h2>
                            <div class="col"></div>
                            <div class="col-3 mx-3">
                                <input type="text" class="form-control form-control-solid " id="search" placeholder="Search"/>
                            </div>
                            <div class="d-flex">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-create">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-9 pb-0">
                        <table class="table table-row-dashed table-row-gray-300 gy-7" id="table-role">
                            <thead>
                            <tr class="fw-bolder fs-6 text-gray-800">
                                <th>Role</th>
                                <th>Guard Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalRole">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" id="modalRoleHeader">
                    <h2 class="fw-bolder">Create Role</h2>
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
                <form id="formRole" method="post">
                    @csrf
                    <input id="id" name="id" value="" type="hidden">
                    <div class="modal-body">
                        <div class="mb-10 ">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter role name"/>
                            <span class="text-danger error-text name_error"></span>
                        </div>

                        <div class="mb-10">
                            <label class="form-label">Permissions</label>
                            <div class="form-check form-check-custom form-check-solid mb-4 m-2">
                                <input class="form-check-input" type="checkbox" id="check_all_permissions">
                                <label class="form-check-label cursor-pointer" for="check_all_permissions">
                                    Check All
                                </label>
                            </div>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-md-3">
                                        <div class="form-check form-check-custom form-check-solid m-2">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                            <label class="form-check-label cursor-pointer" for="permission_{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
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

            $('#check_all_permissions').click(function () {
                if ($(this).is(':checked')) {
                    $('input[type=checkbox]').prop('checked', true);
                } else {
                    $('input[type=checkbox]').prop('checked', false);
                }
            });

            var table = $('#table-role').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('get.roles') }}",
                    data: function (d) {
                        d.search.value = $('#search').val();
                    }
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'guard_name', name: 'guard_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                searching: false,
                sorting: false,
            });

            $('.btn-create').click(function () {

                //reset form
                $('#formRole')[0].reset();
                $('#id').val('');
                $('#check_all_permissions').prop('checked', false);
                $('#modalRole').modal('show');
                $('#modalRoleHeader h2').text('Create Role');

            });
            $('#search').on('keyup', function () {
                var value = this.value;
                table.search(value).draw();
            });
            $('body').on('click', '.btn-edit', function () {
                const id = $(this).data('id');
                const url = "{{ route('roles.edit', ':id') }}".replace(':id', id);
                $.ajax({
                    url: url,
                    data: {id: id},
                    success: function (response) {

                        //reset form
                        $('#formRole')[0].reset();

                        $('#modalRole').modal('show');
                        $('#modalRoleHeader h2').text('Edit Permission');
                        $('#id').val(response.role.id);
                        $('#name').val(response.role.name);
                        $.each(response.role.permissions, function (key, value) {
                            $('#permission_' + value.id).prop('checked', true);
                        });
                    }
                });
            });
            $('body').on('click', '.btn-delete', function () {
                const id = $(this).data('id');
                const url = "{{ route('roles.destroy', ':id') }}".replace(':id', id);
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
                                        $('#table-role').DataTable().ajax.reload();
                                    });
                                }
                            }
                        });
                    }
                });
            });

            $('#formRole').submit(function (e) {
                e.preventDefault();
                const id = $('#id').val();
                let url = id ? "{{ route('roles.update', ':id') }}" : "{{ route('roles.store') }}";
                url = url.replace(':id', id);
                const method = id ? 'patch' : 'POST';
                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function (response) {
                        if(response.success) {
                            //sweet alert
                            $('#modalRole').modal('hide');
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(function () {
                                toastr.success(response.message);

                                $('#formRole')[0].reset();
                                $('#table-role').DataTable().ajax.reload();
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
