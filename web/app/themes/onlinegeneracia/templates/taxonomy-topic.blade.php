@extends('layouts.base')

@section('content')
  <section class="cover-photo-wrap">
    <div class="cover-photo"
      style="background-image: url({{ $topic->cover_photo['sizes']['medium_large'] }});"
    ></div>
  </section>

  <section class="main-wrap">

  </section>
@endsection
