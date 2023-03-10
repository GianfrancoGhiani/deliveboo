<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Deliveboo' }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- dropzone --}}
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link
  rel="stylesheet"
  href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
  type="text/css"
/> 
    
    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="z-index bg-dark-mode text-white">
 <div id="admin">
    @include('partials.admin.sidebar')

    <div id="wrapper">
        @include('partials.admin.header')

        <main class="">
            @yield('content')
        </main>
    </div>

 </div>

  <!--Main layout-->
  @include('partials.admin.modal-delete')
</body>

</html>