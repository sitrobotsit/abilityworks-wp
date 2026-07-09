jQuery($ => {
  $('.st-caro-11').each((index, t) => {
    let $st = $(t),
      $slides = $('.slides', $st),
      totalSlides = $('.slide', $st).length,
      $btnPrev = $('.btn-prev', $st),
      $btnNext = $('.btn-next', $st)
      // $titlebar = $('.titlebar', $st)
    ;

    $slides.slick({
      adaptiveHeight: true,
      autoplay: false,
      speed: 600,
      cssEase: 'ease-out',
      infinite: true,
      dots: false,
      arrows: false,
      fade: true,
      appendArrows: $('.btm-slides-nav', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left-circle"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right-circle"></button>',
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
      ]
    })

    $btnPrev.on('click', e => {
      $slides.slick('slickPrev');
    })
    $btnNext.on('click', e => {
      $slides.slick('slickNext');
    })

    let fitTitlebar = () => {
      $('.titlebar', $st).each((idx, titlebar) => {
        let $titlebar = $(titlebar),
          titleBarH = $titlebar.outerHeight()
        ;
        $titlebar.css('margin-top', '-' + (titleBarH/2) + 'px');
      })
      $slides.slick('setPosition');
    }
    setTimeout(fitTitlebar, 400);
    $(window).on('resize', fitTitlebar);
  })
})
