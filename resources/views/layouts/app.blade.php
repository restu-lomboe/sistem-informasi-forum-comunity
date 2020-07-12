<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>Sanber-Forum | @yield('title')</title>

   <!-- Fonts -->
   <link rel="dns-prefetch" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/style.css') }}" rel="stylesheet">
   <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
   <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">

   <!-- Script -->
   <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   {{--<script src="{{ asset('js/app.js') }}"></script>--}}
   <script src="{{ asset('js/select2.min.js') }}"></script>
   <script src="{{ asset('vendor/laravel-ckeditor/ckeditor.js') }}"></script>
   <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>

</head>
<body>
<div id="app">
   <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style=" background-color: #2ab27b;">
      <div class="container" id="nav_ul">
         <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name') }}
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto" id="nav_ul">
               <li><a class="nav-link" href="{{ route('pertanyaan.index') }}">Forum</a></li>
               {{-- <li><a class="nav-link" href="{{ route('tag.index') }}">{{ __('Tag') }}</a></li> --}}

            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto" id="nav_ul">
               <!-- Authentication Links -->
               @guest
                  <li><a class="nav-link" id="b" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                  <li><a class="nav-link" id="b" href="{{ route('register') }}">{{ __('Register') }}</a></li>
               @else
                  <li class="nav-item dropdown">
                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> Menu <span
                            class="caret"></span>
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('pertanyaan.create') }}" style="color: #444;">
                           {{ __('Buat Pertanyaan') }}
                        </a>
                     </div>
                  </li>

                  <li class="nav-item dropdown">
                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->nama }} <span class="caret"></span>
                     </a>

                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        {{-- <a class="dropdown-item" href="{{ route('profile', Auth::user()->nama) }}"
                           style="color: #444;">
                           {{ __('Profile') }}
                        </a> --}}

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();"
                           style="color: #444;">
                           {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                        </form>
                     </div>
                  </li>
               @endguest
            </ul>
         </div>
      </div>
   </nav>

   <main class="py-4">
      {{-- <div class="container">
         @include('layouts.info')
      </div> --}}
      @yield('content')
      @include('layouts.footer')
   </main>
</div>

<script>
   toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
   }

   @if (session('error') == 'false')
      toastr["success"](`{!! session('message') !!}`)
   @elseif(session('error') == 'true')
      toastr["error"](`{!! session('message') !!}`)
   @endif
   
</script>
</body>
</html>
