@extends('layouts.base')

@section('content')
  @while(have_posts()) @php(the_post())
    <div class="container clearfix">
      @include('partials.page-header')

      @if(have_rows('partner-group'))
        @while(have_rows('partner-group')) @php(the_row())
          <div class="partner-group clearfix">
            @if(get_sub_field('title'))
              <h2>{{ the_sub_field('title') }}</h2>
            @endif

            <div class="partner-list clearfix">
              @while(have_rows('partner-list')) @php(the_row())
              {{-- @php(var_dump(get_sub_field('logo'))) --}}
                <div class="partner">
                  <a href="{{ the_sub_field('link') }}"
                    style="background-image: url('{{ get_sub_field('logo')['sizes']['medium'] }}');">
                  </a>
                </div>
              @endwhile
            </div>
          </div>
        @endwhile
      @endif
    </div>
  @endwhile
@endsection
