jQuery($ => {
  $('.st-articles-latest, .st-articles-by-tag').each((index, t) => {
    let $st = $(t),
      $search = $('.articles-search', $st),
      $btnSearch = $('.btn-search', $st),
      $btnInput = $('.form-control', $search)

    $btnSearch.on('click', () => {
      $search.toggleClass('form-revealed')
      if ($search.hasClass('form-revealed')) {
        $btnInput.focus()
      }
    })
    $btnInput.on('blur', () => {
      setTimeout(() => {
        $search.removeClass('form-revealed')
      }, 500)
    })
  })
})
