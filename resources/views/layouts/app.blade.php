<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ getCurrentPageInfo('meta_title') }}</title>
        <meta name="description" content="{{ getCurrentPageInfo('meta_description') }}">
        
        @if (getCurrentPageInfo('noindex'))
        <!-- Enable/Disable bots from crawling -->
        <meta name="robots" content="noindex">
        @endif

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
   
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        
        {!! getGoogleAnalyticsTag() !!}

        {!! getFbPixelTag() !!}

    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ getSiteLogo() }}" width="150" height="90" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item {{ (\Request::route()->getName() == 'home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item {{ (\Request::route()->getName() == 'contactUs') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/contact-us') }}">Contact Us</a>
                  </li>
                </ul>
            </div>
        </nav>

        @yield('content')

        <!-- Footer Section -->
        <footer class="p-5">
            <div class="container-fluid">
                <p><span class="float-left text-light">©2013-2016 BeMo Academic Consulting Inc. All rights reserved. <a href="#">Disclaimer & Privacy Policy</a> <a href="#">Contact Us</a></span> <span class="float-right social-container"><a href="" class="text-light"><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href="#" class="text-light"><i class="fa fa-twitter" aria-hidden="true"></i></a></span></p>
            </div>
        </footer>
        <!-- End of Footer Section -->
        
        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        @yield('extraScripts')
    </body>
</html>
