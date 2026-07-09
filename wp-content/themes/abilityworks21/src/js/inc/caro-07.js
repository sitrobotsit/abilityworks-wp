jQuery($ => {
  $('.st-caro-07').each((index, t) => {
    let $st = $(t),
      $titlebar = $('.titlebar', $st),
      $slides = $('.slides', $st),
      allSlides = $('.slide', $st),
      $firstSlide = $(allSlides[0]),
      firstSlideColor = $firstSlide.data('color'),
      totalSlides = $('.slide', $st).length,
      $btnPrev = $('.btn-prev', $st),
      $btnNext = $('.btn-next', $st)
    ;

    $titlebar.css('color', firstSlideColor)

    // $slides.on('init', (event, slick) => {
    // })

    $slides.slick({
      adaptiveHeight: true,
      autoplay: false,
      speed: 600,
      cssEase: 'ease-out',
      infinite: true,
      dots: false,
      arrows: true,
      fade: true,
      appendArrows: $('.btm-slides-nav', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left-circle"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right-circle"></button>',
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
      ]
    })

    $slides.on('beforeChange', (event, slick, currentSlide, nextSlide) => {
      let $curSlide = $(allSlides[nextSlide]), color = $curSlide.data('color');
      $titlebar.css('color', color)
    })

    $btnPrev.on('click', e => {
      $slides.slick('slickPrev');
    })
    $btnNext.on('click', e => {
      $slides.slick('slickNext');
    })
  })
})
