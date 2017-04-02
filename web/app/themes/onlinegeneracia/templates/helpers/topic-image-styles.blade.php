{{-- Load topic cover image for each topic on small device inside CSS styles --}}
<style type="text/css">
  @foreach ($topics_cards as $topic)
    @media screen and (max-width: 767px) {
      .topics-index-carousel .topic-{{ $topic->index }} {
        background-image: url("{{ $topic->cover_photo['sizes']['medium'] }}");
      }
    }

    /* Retina phone */
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

    body.is-topic-card-{{ $topic->index }}-loading:before {
      background-image: url("{{ $topic->placeholder_uri }}");
    }

    @foreach ($image_sizes as $size)
      body.is-topic-card-{{ $topic->index }}-{{ $size }}-loaded:after {
        background-image: url("{{ $topic->cover_photo['sizes']['medium'] }}");
        opacity: 1;
      }

      body.is-topic-card-{{ $topic->index }}-{{ $size }}-loaded.topic-faded-out:after {
        opacity: 0;
      }
    @endforeach

  @endforeach
</style>
