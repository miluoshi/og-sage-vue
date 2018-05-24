@extends('layouts.base')

@section('content')
  <section class="main-wrap">
    <div class="cover-photo-wrap">
      <div class="cover-photo"
        style="background-image: url({{ $topic->cover_photo['sizes']['medium_large'] }});"
      ></div>
    </div>

    <div class="main-content-wrap">
      <div class="topic-section topic-intro container">
        <div class="topic-index-wrap">
          <span class="topics-length">{{ $topics_count }}</span>
          <span class="topic-index-slash">/</span>
          <span class="topic-index">@php(printf('%02d', $topic_index))</span>
        </div>

        <h1 class="title">{{ $topic->name }}</h1>

        @if ($topic->subtitle)
          <q>{{ $topic->subtitle }}</q>
        @endif

        <hr />

        <div class="description">
          {!! $topic->description !!}
        </div>
      </div>

      @if (count($articles) > 0)
        <div class="topic-section topic-articles container">
          <h2>ČLÁNKY</h2>

          @foreach ($articles as $i => $article)
            @php
              $article_id = sprintf('%02d', $i);
              global $post;
              $post = $article;
              setup_postdata($article);
            @endphp

            <article id="article-{{ $article_id }}">
              <h3>{{ the_title() }}</h3>

              <p>{{ the_excerpt() }}</p>

              <a href="{{ the_permalink() }}" class="article-link">ZOBRAZ VIAC</a>
            </article>
          @endforeach
          @php(wp_reset_postdata())
        </div>
      @endif

      @if ($topic->links)
        <div class="topic-section topic-links container">
          <h2>ĎALŠIE ODKAZY</h2>

          @foreach ($topic->links as $linkObj)
            @php($link = $linkObj['topic_link'])
            <a class="topic-link"
              href="{{ $link['url'] }}"
              target="{{ $link['target'] }}"
            >
                <h3>{{ $link['title'] }}</h3>
                <span class="topic-link-arrow icon-right"></span>
            </a>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  @if ($topic->video)
    <section class="topic-video-wrap">
      <div class="video-overlay"
        data-video-src="{{ $topic->video->src }}"
        style="background-image: url('{{ $topic->video->thumbnail_url }}');"
      >
        <a class="video-play-button icon-play"></a>

        <div class="topic-video-details">
          <h3>{{ $topic->video->title }}</h3>
          {!! $topic->video->description !!}
        </div>

      </div>
      <iframe id="video" src="" frameborder="0" allowfullscreen></iframe>
    </section>
  @endif

  <section class="adjacent-topic-links">
    @if ($next)
      <div class="next-topic adjacent-topic">
        <a href="{{ $next->url }}"
          style="background-image: url({{ $next->cover_photo['sizes']['medium_large'] }});"
        >
          <label>Ďalšia téma</label>
          <h4>{{ $next->title }}</h4>
        </a>
      </div>
    @endif

    @if ($previous)
      <div class="prev-topic adjacent-topic">
        <a href="{{ $previous->url }}"
          style="background-image: url({{ $previous->cover_photo['sizes']['medium_large'] }});"
        >
          <label>Predchádzajúca téma</label>
          <h4>{{ $previous->title }}</h4>
        </a>
      </div>
    @endif
  </section>
@endsection
