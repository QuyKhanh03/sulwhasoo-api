<!DOCTYPE html>
<html lang="en">
<head>
    <title>Metronic - The World's #1 Selling Bootstrap Admin Template by KeenThemes</title>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="http://authentication/layouts/corporate/sign-in.html" />
    <link rel="shortcut icon" href="{{ asset('theme/assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('theme/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="auth-bg">
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            @yield('content')
            <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                    <a href="#" target="_blank">Terms</a>
                    <a href="#" target="_blank">Plans</a>
                    <a href="#" target="_blank">Contact Us</a>
                </div>
            </div>
        </div>

        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('theme/assets/media/misc/auth-bg.png') }})">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <a href="#" class="mb-0 mb-lg-12">
                    <img alt="Logo" src="{{ asset('theme/assets/media/logos/custom-1.png') }}" class="h-60px h-lg-75px" />
                </a>
                <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ asset('theme/assets/media/misc/auth-screens.png') }}" alt="" />
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1>
                <div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
                    <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a person they’ve interviewed
                    <br />and provides some background information about
                    <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their
                    <br />work following this is a transcript of the interview.</div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.slim.js" ></script>
<script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/scripts.bundle.js') }}"></script>
{{--<script src="{{ asset('theme/assets/js/custom/authentication/sign-in/general.js') }}"></script>--}}

@stack('scripts')
</body>
</html>
