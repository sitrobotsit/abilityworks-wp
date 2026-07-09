jQuery($ => {
  $('.st-caro-01').each((index, t) => {
    let $st = $(t),
      $slides = $('.slides', $st),
      totalSlides = $('.slide', $st).length,
      $btnPlay = $('.btn-play', $st),
      autoplay = true
    ;

    if ( totalSlides <= 1 ) {
      $btnPlay.hide();
      $('.slides-controls', $st).hide();
    }

    $slides.slick({
      adaptiveHeight: false,
      autoplay: autoplay,
      speed: 1500,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      fade: true,
      dots: false,
      arrows: true,
      appendArrows: $('.slides-nav', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left-circle"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right-circle"></button>',
      slidesToScroll: 1,
      slidesToShow: 1,
      pauseOnHover: false,
      responsive: [
      ]
    })

    $btnPlay.on('click', e => {
      if ( !autoplay ) {
        $slides.slick('slickPlay');
        $slides.slick('slickNext');

        $btnPlay.removeClass('icon-play-circle').addClass('icon-pause-circle');

        autoplay = true;
      }
      else {
        $slides.slick('slickPause');

        $btnPlay.removeClass('icon-pause-circle').addClass('icon-play-circle');

        autoplay = false;
      }
    })
  })
})
