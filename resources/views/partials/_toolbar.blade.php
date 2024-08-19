<div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
    <!--begin::Aside user-->
    <!--begin::User-->
    <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
        <!--begin::Symbol-->
        <div class="symbol symbol-50px">
            <img src="{{ auth()->user()->avatar ?? asset('theme/assets/media/svg/avatars/blank.svg') }}" alt="" />
        </div>
        <!--end::Symbol-->
        <!--begin::Wrapper-->
        <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
            <!--begin::Section-->
            <div class="d-flex">
                <!--begin::Info-->
                <div class="flex-grow-1 me-2">
                    <!--begin::Username-->
                    <a href="#" class="text-white text-hover-primary fs-6 fw-bold">@if(auth()->check())
                            {{ auth()->user()->name }}
                        @endif</a>
                    <!--end::Username-->
                    <!--begin::Description-->
                    <span class="text-gray-600 fw-semibold d-block fs-8 mb-1">
                        @if(auth()->check())
                            {{ auth()->user()->role_name }}
                        @endif
                    </span>
                    <!--end::Description-->
                    <!--begin::Label-->
                    <div class="d-flex align-items-center text-success fs-9">
                        <span class="bullet bullet-dot bg-success me-1"></span>online</div>
                    <!--end::Label-->
                </div>
                <!--end::Info-->
                <!--begin::User menu-->
                <div class="me-n2">
                    <!--begin::Action-->
                    <a href="#" class="btn btn-icon btn-sm btn-active-color-primary mt-n2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
                        <i class="ki-duotone ki-setting-2 text-muted fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{ asset('theme/assets/media/avatars/300-1.jpg') }}" />
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">
                                        @if(auth()->check())
                                            {{ auth()->user()->name }}
                                        @endif
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span></div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                                        @if(auth()->check())
                                            {{ auth()->user()->email }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5 my-1">
                            <a href="{{ route('user.account') }}" class="menu-link px-5">Account Settings</a>
                        </div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <div class="menu-item px-5">
                                <button style="background: no-repeat" type="submit" class="border-0  menu-link px-5">Sign Out</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
