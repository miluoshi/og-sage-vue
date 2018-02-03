@extends('layouts.base')

@section('content')
  @while(have_posts()) @php(the_post())
    <div class="container clearfix">
      @include('partials.page-header')

      @if(have_rows('addresses'))
      <div class="addresses">
        @while(have_rows('addresses')) @php(the_row())
          @if(get_sub_field('title'))
            <h2>{{ the_sub_field('title') }}</h2>
          @endif

          <p>{{ the_sub_field('contact_details') }}</p>
          <p></p>
        @endwhile
      </div>
      @endif

      @if (!empty($map))
        <div class="acf-map" style="height: {{ $map_height }}px;"
          data-zoom="{{ $map_zoom }}">
          <div class="marker"
            data-lat="{{ $map['lat'] }}"
            data-lng="{{ $map['lng'] }}">
          </div>
        </div>
      @endif
      {{-- @include('partials.content-page') --}}
    </div>
  @endwhile
@endsection
