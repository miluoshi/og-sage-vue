import Siema from 'siema'
import {hasClass, addClass} from './classNames'
import unwrap from './unwrap'

let carousel
const carouselSelector = '.topics-index-carousel'
const cardsPerPage = 3

function destroyCarousel(carouselObj) {
  carouselObj.destroy()

  // Removes 2 levels of parents - the DOM created by Siema plugin
  document.querySelectorAll('.topic-card').forEach((card) => unwrap(card))
  unwrap(document.querySelectorAll('.topic-card')[0])
}

function insertArrowButtons(carousel) {
  const mainContainer = document.querySelector('main > .container')
  let fragment = document.createDocumentFragment()
  let prevButton = fragment.appendChild(document.createElement('a'))
  let nextButton = fragment.appendChild(document.createElement('a'))

  addClass(prevButton, 'btn-carousel-prev icon-left')
  addClass(nextButton, 'btn-carousel-next icon-right')

  prevButton.addEventListener('click', () => {
    carousel.prev(cardsPerPage)
  })

  nextButton.addEventListener('click', () => {
    carousel.next(cardsPerPage)
  })

  mainContainer.appendChild(fragment)
}

function initSiema() {
  if (hasClass(document.body, 'device-small')) {
    carousel && destroyCarousel(carousel)
    carousel = undefined
  } else if (!carousel) {
    carousel = new Siema({
      selector: carouselSelector,
      draggable: false,
      duration: 250,
      loop: true,
      perPage: {
          767: cardsPerPage,
      },
    })

    insertArrowButtons(carousel)
  }
}

export default () => {
  window.addEventListener('load', initSiema)
  window.addEventListener('resize', initSiema)
}
