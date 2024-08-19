@extends('layouts.layout_auth')
@section('content')
    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
        <div class="w-lg-500px p-10">
            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="post">
                @csrf
                <div class="text-center mb-11">
                    <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                    <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>
                </div>
                <div class="row g-3 mb-9">
                    <div class="col-md-6">
                        <a href="#"
                           class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                            <img alt="Logo" src="{{ asset('theme/assets/media/svg/brand-logos/google-icon.svg') }}"
                                 class="h-15px me-3"/>Sign in with Google</a>
                    </div>
                    <div class="col-md-6">
                        <a href="#"
                           class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                            <img alt="Logo" src="{{ asset('theme/assets/media/svg/brand-logos/apple-black.svg') }}"
                                 class="theme-light-show h-15px me-3"/>
                            <img alt="Logo" src="{{ asset('theme/assets/media/svg/brand-logos/apple-black-dark.svg') }}"
                                 class="theme-dark-show h-15px me-3"/>Sign in with Apple</a>
                    </div>
                </div>
                <div class="separator separator-content my-14">
                    <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                </div>
                <div class="fv-row mb-8">
                    <label for="email" class="form-label fs-6 fw-bolder text-gray-900">Email</label>
                    <input id="email" type="text" placeholder="Email" name="email" autocomplete="off"
                           class="form-control bg-transparent"/>
                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                </div>
                <div class="fv-row mb-3">
                    <label for="password" class="form-label fs-6 fw-bolder text-gray-900">Password</label>
                    <input type="password" id="password" placeholder="Password" name="password"
                           autocomplete="off" class="form-control bg-transparent"/>
                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                </div>

                <div class="d-flex flex-wrap align-items-center justify-content-between align-items-center mb-8">
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check input" type="checkbox" id="remember" name="remember"/>
                        <label class="form-check label fw-bold text-gray-700 fs-6" for="remember">Remember me</label>
                    </div>
                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold ">
                        <div></div>
                        <a href="#" class="link-primary">Forgot Password ?</a>
                    </div>
                </div>
                <div class="d-grid mb-10">
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                        <span class="indicator-label">Sign In</span>
                        <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                    <a href="#" class="link-primary">Sign up</a></div>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function () {
            $('body').on('click', '#kt_sign_in_submit', function (e) {
                e.preventDefault();

                var email = $('#email').val();
                var password = $('#password').val();
                var remember = $('#remember').val();

                // Kiểm tra xem người dùng đã nhập đủ thông tin hay chưa
                if (email && password) {
                    // Hiển thị "Please wait..." và ẩn nút Sign In
                    $(this).find('.indicator-label').hide();
                    $(this).find('.indicator-progress').show();

                    $.ajax({
                        url: "{{ route('login') }}",
                        type: "POST",
                        data: {
                            email: email,
                            password: password,
                            remember: remember,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'You have successfully logged in!',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(function () {
                                window.location.href = "{{ route('dashboard') }}";
                            });
                        },
                        error: function (xhr) {
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
                        complete: function () {
                            $('#kt_sign_in_submit').find('.indicator-label').show();
                            $('#kt_sign_in_submit').find('.indicator-progress').hide();
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please enter both email and password',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        });
    </script>

@endpush
