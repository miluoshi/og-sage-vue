<footer class="content-info">
  <div class="container">
    @php(dynamic_sidebar('sidebar-footer'))

    <div class="nenasli-ste-temu-wrap">
      <a href="{{ $footer_nenasli_ste_temu['link'] }}" target="_blank">
        {{ $footer_nenasli_ste_temu['text'] }}
      </a>
    </div>

    <nav class="nav-social-icons">
      @if (has_nav_menu('social_navigation'))
          {!! wp_nav_menu(['theme_location' => 'social_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</footer>
