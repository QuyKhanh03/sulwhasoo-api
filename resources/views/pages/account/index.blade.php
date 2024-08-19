@extends('layouts.main')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img
                                        src="{{ auth()->user()->avatar ?? asset('theme/assets/media/svg/avatars/blank.svg') }}"
                                        alt="image"/>
                                    <div
                                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                                @if(auth()->check())
                                                    {{ auth()->user()->name }}
                                                @endif
                                            </a>
                                            <a href="#">
                                                <i class="ki-duotone ki-verify fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                        </div>

                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                            <a href="#"
                                               class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2"
                                               title="Role">
                                                <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                                @if(auth()->check())
                                                    {{ auth()->user()->role_name }}
                                                @endif
                                            </a>

                                            <a href="#"
                                               class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                                <i class="ki-duotone ki-sms fs-4">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                @if(auth()->check())
                                                    {{ auth()->user()->email }}
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                         data-bs-target="#kt_account_profile_details" aria-expanded="true"
                         aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Profile Details</h3>
                        </div>
                    </div>
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form" method="post">
                            <!--begin::Card body-->
                            @csrf
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                             style="background-image: url('{{ asset('theme/assets/media/svg/avatars/blank.svg') }}')">
                                            <div class="image-input-wrapper w-125px h-125px"
                                                 style="background-image: url({{ auth()->user()->avatar ?? asset('theme/assets/media/svg/avatars/blank.svg') }})"></div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="ki-duotone ki-pencil fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg"/>
                                                <input type="hidden" name="avatar_remove"/>
                                            </label>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="Cancel avatar">
																<i class="ki-duotone ki-cross fs-2">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                title="Remove avatar">
																<i class="ki-duotone ki-cross fs-2">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
                                        </div>
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label for="name" class="col-lg-4 col-form-label required fw-semibold fs-6">Full
                                        Name</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-12 fv-row">
                                                <input id="name" type="text" name="name"
                                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                       placeholder="Full Name" value="{{ auth()->user()->name }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label for="email"
                                           class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-12 fv-row">
                                                <input id="email" type="email" name="email"
                                                       class="form-control form-control-lg form-control-solid"
                                                       placeholder="Email" value="{{ auth()->user()->email }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label for="phone" class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Contact Phone</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
															<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
															</i>
														</span>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <input id="phone" type="tel" name="phone"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Phone number" value="{{ auth()->user()->phone }}"/>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label for="password" class="col-lg-4 col-form-label  fw-semibold fs-6">New
                                        Password</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-12 fv-row">
                                                <input id="password" type="password" name="password"
                                                       class="form-control form-control-lg form-control-solid"
                                                       placeholder="New Password"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label for="password_confirmation"
                                           class="col-lg-4 col-form-label  fw-semibold fs-6">Confirm
                                        Password</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-12 fv-row">
                                                <input id="password_confirmation" type="password"
                                                       name="password_confirmation"
                                                       class="form-control form-control-lg form-control-solid"
                                                       placeholder="Confirm Password"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard
                                </button>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                                    <span class="indicator-label">Save Changes</span>
                                    <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--end::Content-->
                </div>


            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#kt_account_profile_details_form').submit(function (e) {
                e.preventDefault();
                // Hiển thị "Please wait..." và ẩn label
                //disable button
                $('#kt_account_profile_details_submit').prop('disabled', true);
                $('#kt_account_profile_details_submit').find('.indicator-progress').show();
                $('#kt_account_profile_details_submit').find('.indicator-label').hide();

                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('user.account') }}',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.success) {
                            $('#kt_account_profile_details_submit').prop('disabled', false);
                            $('#kt_account_profile_details_submit').find('.indicator-progress').hide();
                            $('#kt_account_profile_details_submit').find('.indicator-label').show();
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);

                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    },
                    error: function (xhr) {
                        $('#kt_account_profile_details_submit').find('.indicator-progress').hide();
                        $('#kt_account_profile_details_submit').find('.indicator-label').show();

                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = '';
                            $.each(errors, function (key, value) {
                                errorMessages += value[0] + '<br>';
                            });
                            Swal.fire({
                                title: 'Error!',
                                html: errorMessages,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'An unexpected error occurred',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    },
                });
            });
        });
    </script>

@endpush
