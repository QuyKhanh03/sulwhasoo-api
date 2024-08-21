@extends('layouts.main')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush mb-5 mb-xl-10">
                    <div class="card-header">
                        <div class="card-title col d-flex justify-content-between ">
                            <h2 class="mb-0">Categories</h2>
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
                        <table class="table table-row-dashed table-row-gray-300 gy-7" id="table-categories">
                            <thead>
                            <tr class="fw-bolder fs-6 text-gray-800">
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent</th>
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

    <div class="modal fade" id="modalCategory">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="modalCategoryHeader">
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
                <form id="formCategory" method="post">
                    @csrf
                    <input id="id" name="id" value="" type="hidden">
                    <div class="modal-body">
                        <div class="mb-10">
                            <label for="name" class="form-label required">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"/>
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="mb-10">
                            <label for="parent" class="form-label">Parent</label>
                            <select class="form-select" id="parent" name="parent_id">
                                <option value="">Select Parent</option>
                            </select>
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
        $(document).ready(function (){

            $('#parent').select2();

            // Load các category vào Select2
            function loadCategories() {
                $.ajax({
                    url: '{{ route('get.all.categories') }}',
                    type: 'GET',
                    success: function (response) {
                        $('#parent').empty(); // Xóa các option cũ
                        $('#parent').append('<option value="">Select Category</option>'); // Thêm option mặc định
                        $.each(response.categories, function (key, value) {
                            $('#parent').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#parent').select2(); // Khởi tạo lại Select2
                    }
                });
            }

            // Gọi hàm loadCategories() khi trang được tải lần đầu
            loadCategories();

            var table = $('#table-categories').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('get.categories') }}',
                    data: function (d) {
                        d.search = $('#search').val();
                    }
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'parent', name: 'parent'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });
            $('#search').on('keyup', function (){
                table.draw();
            });

            $('.btn-create').click(function () {
                loadCategories();
                $('#modalCategory').modal('show');
                $('#modalCategoryHeader h2').text('Create Category');
                $('#id').val('');
                //reset form
                $('#formCategory').trigger('reset');
            });


            // Edit Category
            $(document).on('click', '.btn-edit', function () {
                const id = $(this).data('id');
                $.ajax({
                    url: "{{ route('categories.edit', ':id') }}".replace(':id', id),
                    type: 'GET',
                    success: function (response) {
                        loadCategories();
                        $('#modalCategory').modal('show');
                        $('#modalCategoryHeader h2').text('Edit Category');
                        $('#id').val(response.category.id);
                        $('#name').val(response.category.name);
                        $('#parent').val(response.category.parent_id).trigger('change');
                    }
                });
            });

            // Delete Category
            $('body').on('click', '.btn-delete', function () {
                const id = $(this).data('id');
                const url = "{{ route('categories.destroy', ':id') }}".replace(':id', id);
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
                                        table.ajax.reload();
                                        loadCategories();
                                    });
                                }
                            }
                        });
                    }
                });
            });


            $('#formCategory').submit(function (e) {
                e.preventDefault();
                const id = $('#id').val();
                let url = id ? "{{ route('categories.update', ':id') }}" : "{{ route('categories.store') }}";
                url = url.replace(':id', id);
                const method = id ? 'patch' : 'POST';
                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function (response) {
                        if(response.success) {
                            $('#modalCategory').modal('hide');
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(function () {
                                toastr.success(response.message);
                                $('#formCategory')[0].reset();
                                loadCategories();
                                table.ajax.reload();
                            });
                        }else {
                            toastr.error(response.message);
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
