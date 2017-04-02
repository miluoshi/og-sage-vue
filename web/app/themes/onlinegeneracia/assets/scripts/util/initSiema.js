import Siema from 'siema'
import {hasClass} from './classNames'
import unwrap from './unwrap'

let carousel
const carouselSelector = '.topics-index-carousel'

function destroyCarousel(carouselObj) {
  carouselObj.destroy()

  // Removes 2 levels of parents - the DOM created by Siema plugin
  document.querySelectorAll('.topic-card').forEach((card) => unwrap(card))
  unwrap(document.querySelectorAll('.topic-card')[0])
}

function initSiema() {
  if (hasClass(document.body, 'device-small')) {
    carousel && destroyCarousel(carousel)
    carousel = undefined
  } else if (!carousel) {
    carousel = new Siema({
      selector: carouselSelector,
      duration: 350,
      perPage: {
          768: 3,
      },
    })
  }
}

export default () => {
  window.addEventListener('load', initSiema)
  window.addEventListener('resize', initSiema)
}
