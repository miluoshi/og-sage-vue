<footer class="content-info">
  <div class="container">
    @php(dynamic_sidebar('sidebar-footer'))

    @if ($missing_topic['link'] && $missing_topic['text'])
      <a class="missing-topic-banner"
        href="{{ $missing_topic['link'] }}">
        {{ $missing_topic['text'] }}
      </a>
    @endif

    <div class="footer-right-wrap">
      <nav class="nav-social-icons">
        @if (has_nav_menu('social_navigation'))
            {!! wp_nav_menu(['theme_location' => 'social_navigation', 'menu_class' => 'nav']) !!}
        @endif
      </nav>

      <small class="project-authors">
        Online generácia je projektom NDS
      </small>
    </div>
  </div>
</footer>
