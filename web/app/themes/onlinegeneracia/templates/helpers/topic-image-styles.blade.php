{{-- Load topic cover image for each topic on small device inside CSS styles --}}
<style type="text/css">
  @foreach ($topics_cards as $topic)
    @media screen and (max-width: 767px) {
      .topics-index-carousel .topic-{{ $topic->index }} {
        background-image: url("{{ $topic->cover_photo['sizes']['medium_large'] }}");
      }
    }
  @endforeach
</style>
