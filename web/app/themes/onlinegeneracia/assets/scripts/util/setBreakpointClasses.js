import { breakpoints } from '../config'
import {addClass, removeClass, hasClass} from './classNames'

function setDeviceSizeClass(element, className, breakpointConfig) {
  const width = window.innerWidth
  const {from, to} = breakpointConfig

  if (
    width >= from
    && width < to
    && !hasClass(element, className)
  ) {
      removeClass(element, 'device-small device-medium device-large')
      addClass(element, className)
  }
}

export default function(element) {
  // Switch body classes depending on screen size
  Object.keys(breakpoints).forEach(className => {
    let breakpoint = breakpoints[className]
    setDeviceSizeClass(element, className, breakpoint)
  })
}
