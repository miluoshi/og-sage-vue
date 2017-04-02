import WebFont from 'webfontloader'
import setBreakpointClasses from '../util/setBreakpointClasses'

function initPage() {
  // Init navigation position above visible area
  let nav = document.querySelectorAll('.nav-primary')[0]
  nav.style.top = - nav.offsetHeight - 1

  setBreakpointClasses(document.body)
}

export default {
  init() {
    // JavaScript to be fired on all pages
    window.addEventListener('load', () => {
      // Load google font
      WebFont.load({google: {families: [
        'PT+Serif:400,400i',
        'Roboto:400,400i,700,900',
        'Roboto+Condensed:400,700',
      ]}})

      initPage()
    })

    window.addEventListener('resize', () => {
      initPage()
    })
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
}
