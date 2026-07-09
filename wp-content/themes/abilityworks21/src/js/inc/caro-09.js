jQuery($ => {
  $('.st-caro-09').each((index, t) => {
    let $st = $(t),
      $slides = $('.slides', $st),
      $intro = $('.intro', $st),
      $titlebar = $('.titlebar', $intro)
    ;

    let fitTitlebar = () => {
      if ( $titlebar.length <= 0 ) return;

      let titleBarH = $titlebar.outerHeight();

      $intro.css('margin-top', '-' + (titleBarH/2) + 'px');
    }
    setTimeout(fitTitlebar, 400);
    $(window).on('resize', fitTitlebar);

    $slides.slick({
      adaptiveHeight: true,
      autoplay: false,
      speed: 800,
      cssEase: 'ease',
      autoplaySpeed: 5000,
      infinite: true,
      dots: false,
      arrows: true,
      fade: true,
      appendArrows: $('.slides-nav', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left-circle"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right-circle"></button>',
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            autoplay: true,
          }
        }
      ]
    })
  })
})
