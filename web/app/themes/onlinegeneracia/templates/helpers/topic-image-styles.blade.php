{{-- Load topic cover image for each topic on small device inside CSS styles --}}
<style type="text/css">
  @foreach ($topics_cards as $topic)
    @media screen and (max-width: 767px) {
      .topics-index-carousel .topic-{{ $topic->index }} {
        background-image: url("{{ $topic->cover_photo['sizes']['medium'] }}");
      }
    }

    /* Retina */
    @media
      only screen and (-webkit-min-device-pixel-ratio: 2) and ( max-width: 767px),
      only screen and (   min--moz-device-pixel-ratio: 2) and ( max-width: 767px),
      only screen and (     -o-min-device-pixel-ratio: 2/1) and ( max-width: 767px),
      only screen and (        min-device-pixel-ratio: 2) and ( max-width: 767px),
      only screen and (                min-resolution: 192dpi) and ( max-width: 767px),
      only screen and (                min-resolution: 2dppx) and ( max-width: 767px)
    {
      .topics-index-carousel .topic-{{ $topic->index }} {
        background-image: url("{{ $topic->cover_photo['sizes']['medium_large'] }}");
      }
    }
  @endforeach
</style>
