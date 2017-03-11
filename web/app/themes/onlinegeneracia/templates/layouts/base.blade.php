<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    @php(do_action('get_header'))

    @include('partials.header')

    <main class="page-container" role="document">
      @yield('content')

      {{--@if (App\display_sidebar())
        <aside class="sidebar">
          @include('partials.sidebar')
        </aside>
      @endif--}}
    </main>

    @php(do_action('get_footer'))

    @include('partials.footer')

    @php(wp_footer())
  </body>
</html>
