<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>todo</title>
    @include('libraries.styles')
</head>
<body>
@include('components.nav')

<div class="body-content">
    @yield('content')
</div>


@include('libraries.scripts')
</body>
</html>

