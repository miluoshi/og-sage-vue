<footer class="content-info">
  <div class="container">
    @php(dynamic_sidebar('sidebar-footer'))

    @if ($missing_topic['link'] && $missing_topic['text'])
      <a class="missing-topic-banner"
        href="{{ $missing_topic['link'] }}">
        {{ $missing_topic['text'] }}
      </a>
    @endif

    <div class="footer-right-wrap">
        <div class="logo-nds"></div>
    </div>
  </div>
</footer>
