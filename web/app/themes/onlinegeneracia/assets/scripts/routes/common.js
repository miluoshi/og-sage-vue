import WebFont from 'webfontloader'
import setBreakpointClasses from '../util/setBreakpointClasses'

export default {
  init() {
    let $body

    $(window).on('load', () => {
      $body = $('body')

      // Load google font
      WebFont.load({google: {families: [
        'PT+Serif:400,400i',
        'Roboto:400,400i,700,900',
        'Roboto+Condensed:400,700',
      ]}})
    })

    // JavaScript to be fired on all pages
    $(window).on('resize load', () => {
      setBreakpointClasses($body || $('body'))

      // Init navigation position above visible area
      let $nav = $('.nav-primary')
      $nav.css('top', - $nav.outerHeight() - 1)
    })


  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
