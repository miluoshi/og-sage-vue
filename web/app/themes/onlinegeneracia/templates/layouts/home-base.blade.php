<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    @php(do_action('get_header'))

    @include('partials.header')

    <main class="page-container" role="document">
      @yield('content')
    </main>

    @php(do_action('get_footer'))

    @include('partials.home-footer')

    @php(wp_footer())
  </body>
</html>
