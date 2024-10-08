<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  <meta name="description" content="@yield('metdescp')">
 @include('partials.hscript')
 @yield('customCss')

</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      @include('partials.header')

      @include('partials.sidebar')
      <!-- Main Content -->
      <div class="main-content">

        @yield('main-content')

      </div>
      @include('partials.footer')
    </div>
  </div>
  @include('partials.fscript')

</body>



@yield('customJS')
</html>
