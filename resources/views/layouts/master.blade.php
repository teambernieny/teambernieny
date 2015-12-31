<!doctype html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title', 'TeamBernieNY')
    </title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
   <link rel="stylesheet" href="/css/teambernieny.css" type="text/css" />
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   <script src="//code.jquery.com/jquery-1.10.2.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    @yield('head')
  </head>
  <div class="container-fluid theme-showcase" role="main">
    <body>
      @yield('nav')
      @yield('header')






      @yield('contents')

      <footer>
        @yield('footer')
      </footer>

    </body>
  </div>
