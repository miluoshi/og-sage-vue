<footer class="content-info">
  <div class="container">
    @php(dynamic_sidebar('sidebar-footer'))

    @if ($missing_topic['link'] && $missing_topic['text'])
      <a class="missing-topic-banner"
        href="{{ $missing_topic['link'] }}"
        target="_blank"
      >
        {{ $missing_topic['text'] }}
      </a>
    @endif
  </div>
</footer>
