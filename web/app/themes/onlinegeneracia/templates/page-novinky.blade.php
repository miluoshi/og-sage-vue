@extends('layouts.base')

@section('content')
  <div class="container clearfix">
    @include('partials.page-header')

    @foreach ($topics_list as $topic)
      @if(count($topic->posts) > 0)
        <div class="topic">
          <a href="{{ $topic->url }}">
            <h2>{{ $topic->name }}</h2>
          </a>

          @foreach ($topic->posts as $i => $article)
            @php
              global $post;
              $post = $article;
              setup_postdata($article);
            @endphp

            @if ($i >= 3)
              <div class="measuring-wrap">
              <div class="wrap">
            @endif

            <article>
              <a href="{{ the_permalink() }}">
                <div class="post-thumbnail"
                  style="background-image: url('{{ get_the_post_thumbnail_url(null, 'medium') }}');">
                </div>

                <h3>{{ the_title() }}</h3>
              </a>
            </article>
          @endforeach
          @php(wp_reset_postdata())

          @if(count($topic->posts) > 3)
            </div></div>
            <div class="btn-container">
              <button class="view-more-btn">Zobraz viac</button>
            </div>
          @endif
        </div>
      @endif
    @endforeach
  </div>
@endsection
