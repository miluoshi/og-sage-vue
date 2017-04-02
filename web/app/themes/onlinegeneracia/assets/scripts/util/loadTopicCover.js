import $ from 'jquery'
import _ from 'lodash'
import isRetina from './isRetina'

function getAllClassNames() {
  const sizes = ['small', 'medium', 'large', 'original']
  const classNamesArray = Object.keys(document.querySelectorAll('.topic-card'))
    .reduce((allClassNames, index) => {
      const topicNumber = index*1 + 1
      const loadedClassNames = sizes.map(size => `is-topic-card-${topicNumber}-${size}-loaded`)

      return allClassNames.concat(loadedClassNames, `is-topic-card-${topicNumber}-loading`)
    }, [])

  return classNamesArray.join(' ')
}

function setLoaded(topicIndex, size) {
  $('body').addClass(`is-topic-card-${topicIndex}-${size}-loaded`)
  $('body').removeClass(`topic-faded-out`)
}

export default function loadTopicCover(element) {
  let img = new Image()
  const width = $(window).width()
  const imageUrl = {
    small: element.getAttribute('data-img-small'),
    medium: element.getAttribute('data-img-medium'),
    large: element.getAttribute('data-img-large'),
    original: element.getAttribute('data-img-original'),
  }
  const origImgWidth = element.getAttribute('data-width-original')
  const topicIndex = element.getAttribute('data-index')

  const shouldLoad = {
    small: !isRetina() && width === 768,
    medium: (!isRetina() && width <= 1024 ) || (isRetina() && width <= 720),
    large: (!isRetina() && width < 1440) || (isRetina() && width <= origImgWidth/2),
  }

  const size = shouldLoad.small && 'small'
    || shouldLoad.medium && 'medium'
    || shouldLoad.large && 'large'
    || 'original'

  const isAlreadyLoaded = $('body').hasClass(`is-topic-card-${topicIndex}-${size}-loaded`)

  if (!isAlreadyLoaded) {
    // Remove all previous class names
    $('body').removeClass(getAllClassNames())

    $('body').addClass(`is-topic-card-${topicIndex}-loading topic-faded-out`)

    img.onload = _.debounce(() => {
      // setTimeout(() => {
      setLoaded(topicIndex, size)
      // }, 1000)
    }, 500)

    img.src = imageUrl[size]
  }
}
