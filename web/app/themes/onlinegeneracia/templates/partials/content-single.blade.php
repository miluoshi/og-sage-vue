<article @php(post_class())>
  <header class="container">
    <h1 class="entry-title">{{ get_the_title() }}</h1>

    @if(get_field('article_quote'))
      <q>
        {{ the_field('article_quote') }}
      </q>

      <hr />
    @endif

    <div class="meta-data">
      @include('partials/entry-meta')
    </div>

    @if(has_excerpt())
      <div class="description">
        {{ the_excerpt() }}
      </div>
    @endif
  </header>

  @if(has_post_thumbnail())
    <div class="cover-image">
      <img src="{{ the_post_thumbnail_url('small') }}"
        srcset="{{ wp_get_attachment_image_srcset(get_post_thumbnail_id()) }}"
        sizes="{{ wp_get_attachment_image_sizes(get_post_thumbnail_id()) }}"
        alt=""
      >
    </div>
  @endif

  <div class="entry-content container">
    @php(the_content())
  </div>

  <footer>
    {!! wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>
</article>
