<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>
@vite('resources/js/app.js')
<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('admin.partials.nav_bar')
@include('admin.partials.side_bar')
    <div class="content-wrapper">
        @yield('content')
    </div>
@include('admin.partials.footer')
</div>
</body>
</html>
