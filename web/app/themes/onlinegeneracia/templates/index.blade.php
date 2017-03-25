@extends('layouts.base')

@section('content')
  {{-- @include('partials.page-header') --}}

  @if ($topics_cards)
    <div class="topics-index-carousel">
      @foreach ($topics_cards as $topic)
        {{-- Load topic cover image for each topic on small device inside CSS styles --}}
        <style>
          @media screen and (max-width: 767px) {
            .topics-index-carousel .topic-{{ $topic->index }} {
              background-image: url("{{ $topic->cover_photo['sizes']['medium_large'] }}");
            }
          }
        </style>

        <a class="topic-card topic-{{ $topic->index }}"
          href="{{ $topic->url }}"
          data-img-placeholder="{{ $topic->cover_photo['sizes']['placeholder'] }}"
          data-img-small="{{ $topic->cover_photo['sizes']['medium_large'] }}"
          data-img-medium="{{ $topic->cover_photo['sizes']['large'] }}"
          data-img-large="{{ $topic->cover_photo['url'] }}"
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
