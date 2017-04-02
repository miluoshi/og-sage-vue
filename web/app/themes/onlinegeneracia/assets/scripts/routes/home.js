import initSiema from '../util/initSiema'
import initTopicCards from '../util/initTopicCards'
import { breakpoints } from '../config'
import loadTopicCover from '../util/loadTopicCover'

export default {
  init() {
    // JavaScript to be fired on the home page
    initSiema()
    initTopicCards()

    window.addEventListener('load', () => {
      let isLargerDevice = window.innerWidth >= breakpoints['device-medium'].from

      if (isLargerDevice) {
        let firstCard = document.querySelectorAll('.topic-card')[0]

        loadTopicCover(firstCard)
      } else {
        document.body.style.backgroundImage = 'none'
      }
    })

    document.querySelectorAll('.topic-card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        loadTopicCover(this)
      })
    })
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
