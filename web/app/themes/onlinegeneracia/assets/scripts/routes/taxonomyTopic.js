import {addClass} from '../util/classNames'

export default {
  init() {
    let overlay = document.querySelector('.video-overlay')

    overlay.addEventListener('click', function() {
      const src = this.getAttribute('data-video-src')
      let videoIframe = document.getElementById('video')

      videoIframe.setAttribute('src', src)

      addClass(this, 'fadeOut')
      // Remove after faded out
      setTimeout(() => {
        this.parentNode.removeChild(this)
      }, 500);

    })
  },
  finalize() {},
}
