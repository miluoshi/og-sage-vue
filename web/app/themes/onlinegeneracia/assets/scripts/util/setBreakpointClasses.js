import $ from 'jquery'
import { breakpoints } from '../config'

function setDeviceSizeClass($element, className, breakpointConfig) {
  const width = $(window).width()
  const {from, to} = breakpointConfig

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
  Object.keys(breakpoints).forEach(className => {
    let breakpoint = breakpoints[className]
    setDeviceSizeClass($element, className, breakpoint)
  })
}
