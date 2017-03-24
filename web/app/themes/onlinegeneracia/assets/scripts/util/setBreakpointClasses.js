import $ from 'jquery'
import { breakpoints } from '../config'

function setDeviceSizeClass($element, breakpointConfig) {
  const width = $(window).width()
  const {className, from, to} = breakpointConfig

  if (
    width >= from
    && width < to
    && !$element.hasClass(className)
  ) {
      $element.removeClass('device-small device-medium device-large')
      $element.addClass(className)
  }
}

export default function($element) {
  // Switch body classes depending on screen size
  breakpoints.forEach(breakpoint => {
    setDeviceSizeClass($element, breakpoint)
  })
}
