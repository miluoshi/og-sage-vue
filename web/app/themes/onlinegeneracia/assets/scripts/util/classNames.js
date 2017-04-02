export function addClass(el, className) {
  if (el.classList) {
    let classNamesArray = className.split(' ')

    if (classNamesArray.length > 1) {
      classNamesArray.forEach(className => addClass(el, className))
    } else {
      el.classList.add(className)
    }
  }
  else {
    el.className += ' ' + className
  }
}

export function removeClass(el, className) {
  if (el.classList) {
    let classNamesArray = className.split(' ')

    if (classNamesArray.length > 1) {
      classNamesArray.forEach(className => removeClass(el, className))
    } else {
      el.classList.remove(className)
    }
  } else {
    el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ')
  }
}

export function hasClass(el, className) {
  if (el.classList)
    return el.classList.contains(className)
  else
    return new RegExp('(^| )' + className + '( |$)', 'gi').test(el.className);
}
