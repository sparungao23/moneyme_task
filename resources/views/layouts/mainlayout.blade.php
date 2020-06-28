<!DOCTYPE html>
<html lang="en">
 <head>
   @include('layouts.partials.header')
 </head>
 <body class="bg-light">
 @include('layouts.partials.navigation')

@yield('content')
@include('layouts.partials.footer')
@include('layouts.partials.footer-scripts')
 </body>
</html>