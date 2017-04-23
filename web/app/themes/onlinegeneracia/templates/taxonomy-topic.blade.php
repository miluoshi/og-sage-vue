@extends('layouts.base')

@section('content')
  <section class="cover-photo-wrap">
    <div class="cover-photo"
      style="background-image: url({{ $topic->cover_photo['sizes']['medium_large'] }});"
    ></div>
  </section>

  <section class="main-wrap">
    <div class="topic-index-wrap">
      <span class="topics-length">{{ $topics_count }}</span>
      <span class="topic-index-slash">/</span>
      <span class="topic-index">@php(printf('%02d', $topic_index))</span>
    </div>
  </section>
@endsection
