<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Larahah</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Cairo:700|Merriweather+Sans:700|Open+Sans" rel="stylesheet">
    <link href="{{ asset('build/css/app.css') }}" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="larahah">
      <larahah-header></larahah-header>
      <main>
        <router-view></router-view>
      </main>
      <larahah-footer></larahah-footer>
    </div>
    <script src="{{ asset('build/js/app.js') }}"></script>
  </body>
</html>
