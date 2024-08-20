<div class="aside-menu flex-column-fluid">
    <div class="hover-scroll-overlay-y mx-3 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
         data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
         data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
        <div
            class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}">
                    <span class="menu-icon">
                        <i class="bi bi-house fs-3"></i>
                    </span>
                    <span class="menu-title
                        {{ request()->routeIs('dashboard') ? 'fw-bold' : '' }}">
                        Dashboard
                    </span>
                </a>
            </div>
            @canany(['view user', 'view role', 'view permission'])
                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion {{ request()->routeIs('users.index') || request()->routeIs('roles.index') || request()->routeIs('permissions.index') ? 'here show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="ki-duotone ki-abstract-28 fs-2">
                            <span class="path1"></span><span class="path2"></span>
                        </span>
                    </span>
                    <span class="menu-title">User Management</span>
                    <span class="menu-arrow"></span>
                </span>
                    <div class="menu-sub menu-sub-accordion"
                         style="display: {{ request()->routeIs('users.index') || request()->routeIs('roles.index') || request()->routeIs('permissions.index') ? 'block' : 'none' }}; overflow: hidden;">
                        @can('view user')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
                                   href="{{ route('users.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                                    <span class="menu-title">Users</span>
                                </a>
                            </div>
                        @endcan
                        @can('view role')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                                   href="{{ route('roles.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                                    <span class="menu-title">Roles</span>
                                </a>
                            </div>
                        @endcan
                        @can('view permission')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('permissions.index') ? 'active' : '' }}"
                                   href="{{ route('permissions.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                                    <span class="menu-title">Permissions</span>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
            @endcanany
            <div data-kt-menu-trigger="click"
                 class="menu-item menu-accordion {{ request()->routeIs('categories.index') ? 'here show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-box-seam fs-2"></i>
                    </span>
                    <span class="menu-title">Product Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion"
                     style="display: {{ request()->routeIs('categories.index') ? 'block' : 'none' }}; overflow: hidden;">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('categories.index') ? 'active' : '' }}"
                           href="{{ route('categories.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                            <span class="menu-title">Categories</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
