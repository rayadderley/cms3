<!--Layouts app.blade.php is a file that will become the Page that used across all VIEWS page-->
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <div class="container">
            @yield('content') <!--Here content section will be displayed-->
        </div>
            @yield('footer') <!--Here footer section will be displayed-->
    </body>
</html>