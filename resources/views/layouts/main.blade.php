<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTablesbootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
        .required:after{
            content:'*';
            color:red;
            padding-left:5px;
        }
        table.table td a.visibility {
            color: blue;
        }
        table.table td a.delete {
            color: #E34724;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        .custom {
            width: 200px !important;
        }
    </style>
</head>

<body class="sb-nav-fixed">
<header id="app">
    @include('layouts.nav')
</header>
<main>
    <div id="layoutSidenav" style=" @yield('layoutSidenav-style')">
    @include('layouts.sidebar')
        <div id="layoutSidenav_content">
    @yield('main-content')
        </div>
    </div>
</main>

<!-- Scripts -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/datatables-demo.js') }}"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/dataTables.js') }}"></script>
<script src="{{ asset('js/dataTables2.js') }}"></script>
<script src="{{ asset('js/fontawesome.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield('more_scripts')
<script>
        $('#select1').select2({
            dropdownParent: $('#addRecord .modal-body'),
            width: "resolve"
        });
        $('#select2').select2({
            dropdownParent: $('#addRecord .modal-body'),
            width: "resolve"
        });
        $('#select3').select2({
            dropdownParent: $('#addRecord .modal-body'),
            width: "resolve"
        });
</script>
<script>
    //alert remove after 5sec
    setTimeout(function() {
        $('#deleteAlert').remove();
    }, 5000);
</script>
</body>
</html>
