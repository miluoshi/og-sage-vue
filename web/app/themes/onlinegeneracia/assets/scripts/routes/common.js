function setBodyClass($body, className, sizeFrom, sizeTo) {
  const width = $(window).width()

  if (width >= sizeFrom && width < sizeTo && !$body.hasClass(className)) {
      $body.removeClass('device-small device-medium device-large')
      $body.addClass(className)
  }
}

export default {
  init() {
    // JavaScript to be fired on all pages
    var $body = $('body')

    // Switch body classes depending on screen size
    $(window).on('resize ready', () => {
      setBodyClass($body, 'device-small', 0, 768)
      setBodyClass($body, 'device-medium', 768, 1024)
      setBodyClass($body, 'device-large', 1024, 99999)
    })
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
