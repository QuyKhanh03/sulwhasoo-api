<!DOCTYPE html>

<html lang="en">
<head>
    <title>
        {{ $title ?? 'Metronic' }}
    </title>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="http://apps/ecommerce/sales/listing.html" />
    <link rel="shortcut icon" href="{{ asset('theme/assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('theme/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @stack('styles')
</head>
<body id="kt_body" class="aside-enabled">
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
            @include('partials._toolbar')
            @include('partials._menu')
        </div>
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
            @include('partials._header')
            @yield('content')
        </div>
    </div>
</div>



<script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/apps/ecommerce/sales/listing.js') }}"></script>
<script src="{{ asset('theme/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}

@stack('scripts')

<script>
    {{--$(document).ready(function() {--}}
    {{--    $('body').on('click', '.btn-sign-out', function(e) {--}}
    {{--        e.preventDefault();--}}

    {{--        //call to route logout--}}
    {{--        $.ajax({--}}
    {{--            url: "{{ route('logout') }}",--}}
    {{--            type: "POST",--}}
    {{--            data: {--}}
    {{--                _token: "{{ csrf_token() }}"--}}
    {{--            },--}}
    {{--            success: function(response) {--}}
    {{--                window.location.reload();--}}
    {{--            }--}}
    {{--        });--}}
    {{--    });--}}
    {{--});--}}
</script>
</body>
</html>
