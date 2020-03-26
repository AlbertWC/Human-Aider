<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Human Trafficking Prevention">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <style>
        .well
        {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.5);
            transition: 0.3s;
        }

        .well:hover,.card:hover
        {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.5);
        }
        #body
        {
            color: #dcdcdc;
            background-color: #dcdcdc;
        }
        .html 
        {
            scroll-behavior: smooth;
            background-color: black;
        }
        /* .card-body:hover
        {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.3)
        } */
        th
        {
            text-align: left;
        }
        .bottomright
        {
            position: absolute;
            right: 50px;
        }
        #btnfunction
        {
            padding-top: 15px;
            display: flex;
            align-items: center;
            justify-content: left;
        }
        #contentdisplay
        {
            justify-content: right;
            padding-top: 15px;
        }
        .a 
        {
            text-align: center;
        }
        #indexdisplay
        {
            border-style: outset;
            border-radius: 15px;
            margin : 5px;
            color: white;
            background-color: white;
        }
        #mainttitle
        {
            margin-left: 100px;
            right: 0px;
        }
        #text
        {
            color : black;
        }
        /* .list
        {
            margin-left: 150px;
        } */
    </style>
</head>
<body>
    @include('inc.navbar')
    
    {{-- @yield('indexgraph') --}}
    <div class="container">
        @yield('maps')
        <div class="col">
            <div class="col-sm-3">
                @yield('buttonfunc')
            </div>
            <div class="col-sm-9">
                @yield('profile')
            </div>
        </div>
    </div>   
    <div id="app">
        <div class="container">
            @include('inc.message')
            <div class="list">
            @yield('content')  

            </div>
            <div class="comment">

             @yield('comment')
            </div>
        </div>
    </div>

    {{-- @yield('graph') --}}


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
