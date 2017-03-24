export default () => {
  $(window).on('load resize', () => {
    // Init topic cards to 1/3 of container height on mobile view
    if ($('body').hasClass('device-small')) {
      let $topicCards = $('.topic-card')
      let visibleAreaHeight = $(window).height() - $('header').height()

      $topicCards.outerHeight(visibleAreaHeight / 3)
    }
  })
}
