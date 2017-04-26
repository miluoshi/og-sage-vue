@extends('layouts.base')

@section('content')
  <section class="cover-photo-wrap">
    <div class="cover-photo"
      style="background-image: url({{ $topic->cover_photo['sizes']['medium_large'] }});"
    ></div>
  </section>

  <section class="main-wrap">
    <div class="topic-intro container">
      <div class="topic-index-wrap">
        <span class="topics-length">{{ $topics_count }}</span>
        <span class="topic-index-slash">/</span>
        <span class="topic-index">@php(printf('%02d', $topic_index))</span>
      </div>

      <h1 class="title">{{ $topic->name }}</h1>

      <q>{{ $topic->subtitle }}</q>

      <hr />

      <div class="topic-description">
        {!! $topic->description !!}
      </div>
    </div>

    @if (have_rows('articles'))
      <div class="topic-section topic-articles container">
        <h2>ČLÁNKY</h2>

        @php($i = 0)
        @while(have_rows('articles')) @php(the_row())
          @php($article_id = sprintf('%02d', $i))

          <article id="article-{{ $article_id }}">
            <h3>@php(the_sub_field('title'))</h3>

            <p>@php(the_sub_field('description'))</p>

            <a href="@php(the_sub_field('link'))" class="article-link" target="_blank">ZOBRAZ VIAC</a>
          </article>

          @php($i++)
        @endwhile
      </div>
    @endif
  </section>
@endsection
