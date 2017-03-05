<header>
  <div class="container">
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}

        <ul class="navigation-topics">
          @foreach ($navigation_topics as $topic)
            <li>
              <a href="{{$topic['url']}}">
                {{$topic['name']}}
              </a>
            </li>
          @endforeach
        </ul>
      @endif
    </nav>

    <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
  </div>

  <div class="social-icons">

  </div>
</header>
