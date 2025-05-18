<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.head')

<body class="bg-gradient-secondary">

    <div class="container">
        @yield('content')
    </div>

    @include('layouts.partials.js')
</body>

</html>