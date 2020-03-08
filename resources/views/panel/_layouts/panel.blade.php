
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - @yield('_titulo_pagina_') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{!! mix('css/app.css') !!}"/>
    <link rel="stylesheet" href="{!! mix('css/theme.css') !!}"/>
    <link rel="stylesheet" href="{!! mix('css/select2.css') !!}"/>
    <link rel="stylesheet" href="{!! mix('css/datepicker.css') !!}"/>

    @yield('styles')
    <style>

        .form-control, .single-line {
            border: 1px solid rgb(223, 225, 229);
        }

        .select2-container--bootstrap4 .select2-dropdown {
            z-index: 9999;
        }

        .navbar ul .dropdown-menu {
            min-width: 13rem !important;
        }

        .select2-selection {
            padding: 0;
        }

        @media only screen and (max-width: 768px) {
            .top-navigation .wrapper.wrapper-content {
                padding: 10px 0px;
            }
        }

        .skin-1 .navbar-static-top {
            background: #ccc;
        }

        .skin-1 .nav>li.active {
            background: #333;
        }

        .skin-1 .nav>li.active {
            background: #666;
        }

        .skin-1 .nav > li > a:hover,
        .skin-1 .nav > li > a:focus {
            background-color: #999;
            color: white;
        }

        .top-navigation .dropdown-menu>li>a:focus,
        .top-navigation .dropdown-menu>li>a:hover {
            color: #fff;
            background-color: #999;
        }

        .skin-1 .nav>li.active>a {
            color: #1b1e21;
        }

        .skin-1 .nav>li>a {
            color: #666;
        }

        .low {
            color: blue;
            text-transform: capitalize;
            font-weight: bold;
        }
        .normal {
            color:#bdae00;
            text-transform: capitalize;
            font-weight: bold;
            text-shadow: #1b1e21;
        }
        .high {
            color: red;
            text-transform: capitalize;
            font-weight: bold;
        }
        .ck-editor__editable {
            min-height: 240px;
        }
    </style>

    <script src="//code.jivosite.com/widget/ZJaoWhJIhs" async></script>

</head>
<body class="top-navigation skin-1">
<div id="app">
    <!-- Wrapper-->
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">

        @if(!request()->has('iframe'))

            @include('panel._layouts.main-navigation')
        @endif
        <!-- Main view  -->
            <div id="topo-tela"></div>
        @yield('content')

        <!-- Footer -->
            @if(!request()->has('iframe'))
                @include('panel._layouts.footer')
            @endif
        </div>
        <!-- End page wrapper-->
    </div>
</div>
<!-- End wrapper-->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>
<script src="{{ mix('/js/custom-masks.js') }}"></script>
<script src="{{ mix('/js/moment.js') }}"></script>
{{--<script src="{{ mix('/js/blockUI.js') }}"></script>--}}
<script src="{{ mix('/js/functions.js') }}"></script>

{{--<script src="{{ mix('/js/custom-select2.js') }}"></script>
<script src="{{ mix('/js/custom-datepicker.js') }}"></script>
<script src="{{ mix('/js/custom-datetimepicker.js') }}"></script>--}}


@section('scripts')
@show
<script>
    $(function () {
        //$('[data-toggle="tooltip"]').tooltip();
        //$('[data-tooltip=tooltip"]').tooltip();
    });

    @if (Session::has('message'))
    showMessage('{{ session('messageType') }}', '{{ session('message') }}');
    @endif

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
