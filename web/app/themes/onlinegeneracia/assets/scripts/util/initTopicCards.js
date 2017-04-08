import {hasClass} from './classNames'
import throttle from './throttle'

function init() {
  const headerHeight = document.querySelector('header').offsetHeight
  const visibleAreaHeight = window.innerHeight - headerHeight

  // Init topic cards to 1/3 of container height on mobile view
  if (hasClass(document.body, 'device-small')) {
    let topicCards = document.querySelectorAll('.topic-card')

    topicCards.forEach(card => {
      card.style.height = visibleAreaHeight / 3 + 'px'
    })
  }
  // or to maximum height on tablet/desktop
  else {
    let carousel = document.querySelector('.topics-index-carousel')
    const footerHeight = document.querySelector('footer').offsetHeight

    carousel.style.height = (visibleAreaHeight - footerHeight) + 'px'
  }
}

export default () => {
  window.addEventListener('load', init)
  window.addEventListener('resize', throttle(init, 150))
}
