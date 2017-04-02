import {hasClass} from './classNames'

function init() {
  // Init topic cards to 1/3 of container height on mobile view
  if (hasClass(document.body, 'device-small')) {
    let topicCards = document.querySelectorAll('.topic-card')
    const headerHeight = document.querySelector('header').offsetHeight
    const visibleAreaHeight = window.innerHeight - headerHeight

    topicCards.forEach(card => {
      card.style.height = visibleAreaHeight / 3 + 'px'
    })
  }
}

export default () => {
  window.addEventListener('load', init)
  window.addEventListener('resize', init)
}
