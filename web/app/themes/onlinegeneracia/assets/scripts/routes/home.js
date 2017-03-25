import initSiema from '../util/initSiema'
import initTopicCards from '../util/initTopicCards'
import { breakpoints } from '../config'
import loadTopicCover from '../util/loadTopicCover'
import $ from 'jquery'

export default {
  init() {
    // JavaScript to be fired on the home page
    initSiema()
    initTopicCards()

    $(window).on('load', () => {
      let isLargerDevice = $(window).width() > breakpoints['device-medium'].from

      if (isLargerDevice) {
        let firstCard = document.querySelectorAll('.topic-card')[0]

        loadTopicCover(firstCard)
      } else {
        document.body.style.backgroundImage = 'none'
      }
    })
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
