import initSiema from '../util/initSiema'
import $ from 'jquery'

export default {
  init() {
    // JavaScript to be fired on the home page

    initSiema()

    $(window).on('load resize', () => {
      // Init topic cards to 1/3 of container height on mobile view
      if ($('body').hasClass('device-small')) {
        let $topicCards = $('.topic-card')
        let visibleAreaHeight = $(window).height() - $('header').height()

        $topicCards.outerHeight(visibleAreaHeight / 3)
      }
    })

  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
