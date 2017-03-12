@extends('layouts.base')

@section('content')
  {{-- @include('partials.page-header') --}}

  @if ($topics_cards)
    <div class="topics-index-carousel">
      @foreach ($topics_cards as $topic)
          <div class="topic-card"
            style="background-image: url('{{ $topic->cover_photo['sizes']['medium_large'] }}');"
          >
            <div class="topic-index-wrap">
              <span class="topics-length">{{ sizeof($topics) }}</span>
              <span class="topic-index-slash">/</span>
              <span class="topic-index">{{$topic->index }}</span>
            </div>
            {{$topic->name}}
          </div>
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
