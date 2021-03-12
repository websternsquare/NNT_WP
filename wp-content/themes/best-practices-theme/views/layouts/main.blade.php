<!DOCTYPE html>
<html>
    <head>
        @section('head')
            <meta charset="{{bloginfo( 'charset' )}}">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>
            <link rel="profile" href="http://gmpg.org/xfn/11">

            {!! wp_head() !!}
            <link href="fonts/otari/stylesheet.css" rel="stylesheet">
            <link href="fonts/halohand/stylesheet.css" rel="stylesheet">
            <link rel="stylesheet" href="{{mix('main.css')}}">
        @show
    </head>

    <body>
        @section('header')
            @include('views.partials.header')
        @show

        @yield('pre-content')

        @section('the-loop')
            @if (have_posts())
                @yield('content')
            @else
                @yield('no-content')
            @endif
        @show

        @yield('post-content')

        @section('footer')
            @include('views.partials.footer')
        @show

        @section('scripts')
            <script src="{{mix('main.js')}}"></script>
            <?php wp_footer(); ?>
        @show
    </body>

</html>