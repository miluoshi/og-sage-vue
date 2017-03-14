import WebFont from 'webfontloader'

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
    let $body = $('body')

    // Switch body classes depending on screen size
    $(window).on('resize load', () => {
      setBodyClass($body, 'device-small', 0, 768)
      setBodyClass($body, 'device-medium', 768, 1024)
      setBodyClass($body, 'device-large', 1024, 99999)
    })

    $(window).on('load', () => {
      // Load google font
      WebFont.load({google: {families: [
        'PT Serif:400,400i',
        'Lato:400,400i,700,900',
        'Roboto+Condensed:400,700',
      ]}})

      // Init navigation position above visible area
      let $nav = $('.nav-primary')
      $nav.css('top', - $nav.outerHeight() - 1)
    })


  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
