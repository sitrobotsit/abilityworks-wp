jQuery($ => {
  $('.st-newsroom-search-results').each((index, t) => {
    let $st = $(t),
      $slides = $('.slides', $st),
      totalSlides = $('.slide', $st).length,
      $slidesControls = $('.slides-controls', $st),
      $btnPlay = $('.btn-play', $st),
      autoplay = true
    ;

    if ( totalSlides <= 1 ) {
      $slidesControls.hide();
    }

    $slides.slick({
      adaptiveHeight: false,
      autoplay: autoplay,
      speed: 600,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      dots: false,
      arrows: true,
      appendArrows: $('.slides-nav', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left-circle"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right-circle"></button>',
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 2561,
          settings: 'unslick'
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 768,
          settings: {
            centerMode: true,
            centerPadding: 0,
            slidesToShow: 1,
          }
        }
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
    $btnSearch.on('click', e => {
      $slidesControls.toggleClass('form-revealed')
      if ( $slidesControls.hasClass('form-revealed') ) {
        $btnInput.focus()
      }
    })
    $btnInput.on('blur', e => {
      setTimeout(() => {
        $slidesControls.removeClass('form-revealed')
      }, 500)
    })
  })
})
