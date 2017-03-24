import initSiema from '../util/initSiema'
import initTopicCards from '../util/initTopicCards'
import $ from 'jquery'

export default {
  init() {
    // JavaScript to be fired on the home page

    initSiema()
    initTopicCards()

  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
