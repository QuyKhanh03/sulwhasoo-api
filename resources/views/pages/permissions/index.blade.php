@extends('layouts.main')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush mb-5 mb-xl-10">
                    <div class="card-header">
                        <div class="card-title col d-flex justify-content-between ">
                            <h2 class="mb-0">Permissions</h2>
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
                        <table class="table table-row-dashed table-row-gray-300 gy-7" id="table-permissions">
                            <thead>
                            <tr class="fw-bolder fs-6 text-gray-800">
                                <th>Permission</th>
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
    <div class="modal fade" id="modalPermission">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="modalPermissionHeader">
                    <h2 class="fw-bolder">Create Permission</h2>
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
                <form id="formPermission" method="post">
                    @csrf
                    <input id="id" name="id" value="" type="hidden">
                    <div class="modal-body">
                        <div class="mb-10">
                            <label for="name" class="form-label">Permission Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter permission name"/>
                            <span class="text-danger error-text name_error"></span>
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
            var table = $('#table-permissions').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('get.permissions') }}",
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
            });

            $('.btn-create').click(function () {
                $('#modalPermission').modal('show');
                $('#modalPermissionHeader h2').text('Create Permission');
            });
            $('#search').on('keyup', function () {
                var value = this.value;
                table.search(value).draw();
            });
            $('body').on('click', '.btn-edit', function () {
                const id = $(this).data('id');
                const url = "{{ route('permissions.edit', ':id') }}".replace(':id', id);
                $.ajax({
                    url: url,
                    data: {id: id},
                    success: function (response) {
                        $('#modalPermission').modal('show');
                        $('#modalPermissionHeader h2').text('Edit Permission');
                        $('#id').val(response.data.id);
                        $('#name').val(response.data.name);
                    }
                });
            });

            $('body').on('click', '.btn-delete', function () {
                const id = $(this).data('id');
                const url = "{{ route('permissions.destroy', ':id') }}".replace(':id', id);
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
                                        $('#table-permissions').DataTable().ajax.reload();
                                    });
                                }
                            }
                        });
                    }
                });
            });

            $('#formPermission').submit(function (e) {
                e.preventDefault();
                const id = $('#id').val();
                let url = id ? "{{ route('permissions.update', ':id') }}" : "{{ route('permissions.store') }}";
                url = url.replace(':id', id);
                const method = id ? 'patch' : 'POST';
                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function (response) {
                        if(response.success) {
                            //sweet alert
                            $('#modalPermission').modal('hide');
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(function () {
                                toastr.success(response.message);

                                $('#formPermission')[0].reset();
                                $('#table-permissions').DataTable().ajax.reload();
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
