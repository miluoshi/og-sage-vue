import $ from 'jquery'
import isRetina from './isRetina'

export default function loadTopicCover(element) {
  const imageUrls = {
    placeholder: element.getAttribute('data-img-placeholder'),
    small: element.getAttribute('data-img-small'),
    medium: element.getAttribute('data-img-medium'),
    large: element.getAttribute('data-img-large'),
    original: element.getAttribute('data-img-original'),
  }

  document.body.style.backgroundImage = `url("${imageUrls.placeholder}")`
}
