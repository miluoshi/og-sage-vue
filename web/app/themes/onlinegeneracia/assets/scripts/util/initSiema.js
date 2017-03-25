import $ from 'jquery'
import Siema from 'siema'

let carousel
const $body = $('body')
const carouselSelector = '.topics-index-carousel'

function destroyCarousel(carouselObj) {
  carouselObj.destroy()

  // Removes 2 levels of parents - the DOM created by Siema plugin
  $('.topic-card').unwrap()
  $('.topic-card:first').unwrap()
}

export default () => {
  $(window).on('load resize', () => {
    if ($body.hasClass('device-small')) {
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
  })
}
