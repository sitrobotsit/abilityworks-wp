jQuery($ => {
  $('.st-faqs').each((index, st) => {
    let $st = $(st), $loader = $('.faqs-loader', $st),
      $wrapper = $('.faqs-wrapper', $st),
      $left = $('.left-col', $st),
      $right = $('.right-col', $st),
      catid = $st.data('catid')
    ;

    let loadFAQs = pageno => {
      $loader.html('<span class="loading">Loading...</span>');
      $.get(awObj.ajaxurl, {
        action: 'aw_load_faqs',
        pageno,
        catid,
      }, rs => {
        $left.append( rs.left );
        $right.append( rs.right );
        $loader.html( rs.loader );
      }, 'json')
    }

    loadFAQs(1);

    $('body').on('click', '.btn-more-faqs', e => {
      let $btn = $(e.currentTarget), pageno = $btn.attr('rel');
      loadFAQs( pageno );
    })
  })
})
