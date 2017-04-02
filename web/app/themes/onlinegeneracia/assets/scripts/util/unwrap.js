export default function(el) {
  // place childNodes in document fragment
  let docFrag = document.createDocumentFragment()
  let wrapper = el.parentNode

  while (wrapper.firstChild) {
      var child = wrapper.removeChild(wrapper.firstChild)
      docFrag.appendChild(child)
  }

  // replace wrapper with document fragment
  wrapper.parentNode.replaceChild(docFrag, wrapper)
}
