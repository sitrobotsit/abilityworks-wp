jQuery($ => {
  let resetTitlebar = () => {
    $('.titlebar').each((index, t) => {
      let $t = $(t), $txt = $('.txt', $t),
        $bg = $('.bg', $t),
        textWidth = $txt.width()
      ;

      // console.log($bg.css('text-align'));

      if ( $bg.css('text-align') == 'left' ) {
        $bg.css('width', (textWidth + 25) + 'px');
      }
      else {
        $bg.css('width', 'calc(50% + ' + (textWidth/2 + 25) + 'px)');
      }
    })
  }
  resetTitlebar();

  $(window).on('resize', resetTitlebar);
})
