<header>
  <div class="container">
    <input type="checkbox"
      name="navigation-toggle"
      id="navigation-toggle"
    />
    <label for="navigation-toggle" class="navigation-toggle-open"><span></span></label>

    <nav class="nav-primary">
      <div class="container">
        <div class="nav-header">
          <label for="navigation-toggle" class="navigation-toggle-close"><span></span></label>

          <nav class="nav-social-icons">
            @if (has_nav_menu('social_navigation'))
                {!! wp_nav_menu(['theme_location' => 'social_navigation', 'menu_class' => 'nav']) !!}
            @endif
          </nav>
        </div>

        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}

          <hr />

          <ul class="navigation-topics nav">
            @foreach ($topics as $topic)
              <li>
                <a href="{!! get_term_link($topic->slug, 'topic') !!}">
                  {{ $topic->name }}
                </a>
              </li>
            @endforeach

            @foreach ($topics as $topic)
              <li>
                <a href="{!! get_term_link($topic->slug, 'topic') !!}">
                  {{ $topic->name }}
                </a>
              </li>
            @endforeach

            @foreach ($topics as $topic)
              <li>
                <a href="{!! get_term_link($topic->slug, 'topic') !!}">
                  {{ $topic->name }}
                </a>
              </li>
            @endforeach
          </ul>
        @endif
      </div>

      @if ($missing_topic['link'] && $missing_topic['text'])
        <a class="missing-topic-banner"
          href="{{ $missing_topic['link'] }}"
          target="_blank"
        >
          {{ $missing_topic['text'] }}
        </a>
      @endif
    </nav>

    @if ($theme_logo)
      <a class="site-logo" href="/">
        <img src="{{$theme_logo[0]}}" alt="logo" />
      </a>
    @else
      <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
    @endif

    <nav class="nav-social-icons">
      @if (has_nav_menu('social_navigation'))
          {!! wp_nav_menu(['theme_location' => 'social_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>

  </div>

</header>
