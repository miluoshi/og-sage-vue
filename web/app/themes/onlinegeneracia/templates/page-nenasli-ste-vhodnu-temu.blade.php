@extends('layouts.base')

@section('content')
  @while(have_posts()) @php(the_post())
    <div class="container text-center">
      @include('partials.page-header')
      @include('partials.content-page')
    </div>
  @endwhile
@endsection
