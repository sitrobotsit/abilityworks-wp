jQuery($ => {
  $('.st-highlighted-video').each((idx, st) => {
    let $st = $(st);

    if ( $st.data('scroll-here') == 'yes' ) {
      $('html,body').animate({
        scrollTop: $st.offset().top - $('#header').outerHeight() - 50
      }, 600);
    }
  })

  $('body').on('click', '.hl-video-play', e => {
    let $a = $(e.currentTarget),  height = $a.height(),
      $vidArea = $a.parents('.vid-area'),
      videoSrc = $a.attr('rel');

    let iframeHTML = '<div class="video-wrapper" style="0height:' + height + 'px;">\
      <iframe src="' + videoSrc + '" frameborder="0" allow="autoplay" allowfullscreen></iframe>\
    </div>';

    $vidArea.addClass('active')
      .append(iframeHTML);
  })
})
