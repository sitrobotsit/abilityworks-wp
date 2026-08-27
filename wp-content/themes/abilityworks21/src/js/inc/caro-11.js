jQuery($ => {
  $('.st-caro-11').each((index, t) => {
    let $st = $(t)

    let fitTitlebar = () => {
      $('.titlebar', $st).each((idx, titlebar) => {
        let $titlebar = $(titlebar)
        $titlebar.css('margin-top', '-' + $titlebar.outerHeight() / 2 + 'px')
      })
    }
    setTimeout(fitTitlebar, 400)
    $(window).on('resize', fitTitlebar)
  })
})
