

export default {
  init() {
    let overlay = document.querySelector('.video-overlay')

    overlay.addEventListener('click', function() {
      const src = this.getAttribute('data-video-src')
      let videoIframe = document.getElementById('video')

      videoIframe.setAttribute('src', src)
      this.parentNode.removeChild(this)
    })
  },
  finalize() {},
}
