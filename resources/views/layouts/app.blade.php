<html>
    <head>
        <title>App Name - @yield('title')</title>

        <link href="{{ asset('/public/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/public/css/main.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('/public/js/jquery-3.3.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/public/js/main.js') }}"></script>


    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>

        <footer>
            <?php
               $collection = DB::table('visitors')
                 ->select('browser', DB::raw('count(*) as total'))
                 ->groupBy('browser')
                 ->get();
                // dd($collection);
                foreach($collection as $item){
                    echo "<span style='color: red;'><span>".$item->browser."</span> <span>".$item->total."</span></span>      |  ";
                }
            ?>
        </footer>
    </body>
</html>
