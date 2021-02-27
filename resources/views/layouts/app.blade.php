<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <!-- Fonts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"  crossorigin="anonymous">
   
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet"> 
</head>
<body>
    <div id="app">
        @includeIf('layouts.header', ['some' => 'data'])

        <main class="">
            @yield('page')
        </main>
    </div>
    @include('auth.popup.login')
    @include('auth.popup.register')

    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
  function remoevmsg(){
      $('.logo .alert-danger').remove()
  }
   $(document).on('click', '.nav-item a',function () {
           $this = $(this);
           $model = $this.data('toggle');
           if($model == "modal"){
              remoevmsg()
           }
       
     });
   $(document).on('click', '.auth_modal',function () {
           $this = $(this);
           target = $this.data('target');
           target = $this.data('target');
           remoevmsg()
           if(target == "#registerModal"){
               
              $('#loginModal').modal ('hide')
           }else{
                $('#registerModal').modal ('hide')
               
           }
     });
 $(document).on('click', '.mobile_menu',function () {
            $(".menus").toggle();
     });


    </script>
    @yield('scripts')
</body>
</html>