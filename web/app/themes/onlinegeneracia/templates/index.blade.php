@extends('layouts.base')

@section('content')
  {{-- @include('partials.page-header') --}}

  @if ($topics_cards)
    <div class="container">
      @include('helpers.topic-image-styles')

      <div class="topics-index-carousel">
        @foreach ($topics_cards as $topic)
          <a class="topic-card topic-{{ $topic->index }}"
            href="{{ $topic->url }}"
            data-index="{{ $topic->index }}"
            {{-- data-img-placeholder="{{ $topic->placeholder_uri }}" --}}
            data-img-small="{{ $topic->cover_photo['sizes']['medium'] }}"
            data-img-medium="{{ $topic->cover_photo['sizes']['medium_large'] }}"
            data-img-large="{{ $topic->cover_photo['sizes']['large'] }}"
            data-img-original="{{ $topic->cover_photo['url'] }}"
            data-width-original="{{ $topic->cover_photo['width'] }}"
          >
            <div class="topic-index-wrap">
              <span class="topics-length">{{ sizeof($topics) }}</span>
              <span class="topic-index-slash">/</span>
              <span class="topic-index">@php(printf('%02d', $topic->index))</span>
            </div>

            <h2 class="topic-name">
              {{ $topic->name }}
            </h2>
          </a>
        @endforeach
      </div>
    </div>
  @endif

  {{--
  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  @while (have_posts()) @php(the_post())
    @include ('partials.content-'.(get_post_type() !== 'post' ? get_post_type() : get_post_format()))
  @endwhile
  --}}

  {!! get_the_posts_navigation() !!}
@endsection
