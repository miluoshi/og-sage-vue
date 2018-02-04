export default {
  init() {
    const topics = document.querySelectorAll('.topic')

    topics.forEach(topicEl => {
      const viewMoreBtn = topicEl.querySelector('.view-more-btn')
      const measuringWrapEl = topicEl.querySelector('.measuring-wrap')
      const wrapEl = topicEl.querySelector('.wrap')

      if (viewMoreBtn) {
        viewMoreBtn.addEventListener('click', _e => {
          const wrapperHeight = measuringWrapEl.clientHeight
          const wasCollapsed = !wrapperHeight

          measuringWrapEl.style.height = wasCollapsed
          ? wrapEl.clientHeight + 'px'
          : 0 + 'px'

          viewMoreBtn.innerText = wasCollapsed
            ? 'Zobraz menej'
            : 'Zobraz viac'
        })
      }
    })
  },
}
