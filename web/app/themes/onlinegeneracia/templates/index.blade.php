@extends('layouts.base')

@section('content')
  {{-- @include('partials.page-header') --}}

  @if ($topics)

    <div class="topics-index-carousel">
      @foreach ($topics as $topic)
          <div class="topic-card">
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
