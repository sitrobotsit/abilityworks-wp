jQuery($ => {
  let $win = $(window);

  $('.st-member-info').each((index, t) => {
    let $st = $(t),
      $info = $('.info', $st),
      $titlebar = $('.titlebar', $info)
    ;

    let fitTitlebar = () => {
      if ( $titlebar.length <= 0 ) return;

      if ( $win.width() > 768 ) {
        $info.css('margin-top', '');
      }
      else {
        let titleBarH = $titlebar.outerHeight();

        $info.css('margin-top', '-' + (titleBarH/2) + 'px');
      }
    }

    setTimeout(fitTitlebar, 400);

    $(window).on('resize', fitTitlebar);
  })
})
