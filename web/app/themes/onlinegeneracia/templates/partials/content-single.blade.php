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
      <img src="{{ $featured_img->thumbnail_url }}"
        srcset="{{ $featured_img->srcset }}"
        sizes="(max-width: 992px) 100vw, 992px"
        alt=""
      />
    </div>
  @endif

  <div class="entry-content container">
    @if(have_rows('layout_block'))
      @while(have_rows('layout_block')) @php(the_row())
        <div class="layout-row">
          @if(get_row_layout() === 'text')
            {{-- fields: layout, subtitle, quote, column_1, column_2, image --}}
            <div class="pre-text-column">
              <h3>{{ the_sub_field('subtitle') }}</h3>
            </div>

            @if(get_sub_field('layout') === '1_col')
              @if(get_sub_field('image'))
                <div class="text-column">
                  {{ the_sub_field('column_1') }}
                </div>
                <div class="text-column image-column">
                  @php($img_data = $get_image_data(get_sub_field('image'), 'thumbnail'))
                  <img src="{{ $img_data['src'] }}"
                    srcset="{{ $img_data['srcset'] }}"
                    sizes="(max-width: 767px) 100vw, 320px"
                  />
                </div>
              @else
                <div class="text-column-merged">
                  {{ the_sub_field('column_1') }}
                </div>
              @endif
            @else {{-- 2 columns --}}
              <div class="text-column">
                {{ the_sub_field('column_1') }}
              </div>
              <div class="text-column">
                {{ the_sub_field('column_2') }}
              </div>
            @endif

            @if(get_sub_field('quote'))
              <div class="pre-text-column quote-column">
                <q>{{ the_sub_field('quote') }}</q>
              </div>
            @endif
          @endif

          @if(get_row_layout() === 'video')
            {{-- fields: video_title, video --}}
            <div class="pre-text-column">
              <h3>{{ the_sub_field('video_title') }}</h3>
            </div>
            <div class="text-column-merged">
              {{ the_sub_field('video') }}
            </div>
          @endif
        </div>
      @endwhile
    @else
      @php(the_content())
    @endif
  </div>

  {{-- <footer>
    {!! wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer> --}}
</article>
