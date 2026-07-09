jQuery($ => {
  $('.st-latest').each((index, t) => {
    let $st = $(t);

    // newsroom
    let $newsroomCarousel = $('.newsroom-carousel', $st),
      $btnPlayNewsroom = $('.btn-play-newsroom', $st),
      newsroomCarouselAutoplay = false
    ;
    $newsroomCarousel.slick({
      adaptiveHeight: true,
      autoplay: newsroomCarouselAutoplay,
      speed: 600,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      dots: false,
      arrows: true,
      appendArrows: $('.newsroom-carousel-nav', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left-circle"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right-circle"></button>',
      slidesToShow: 2,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 2561,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });
    $btnPlayNewsroom.on('click', e => {
      if ( !newsroomCarouselAutoplay ) {
        $newsroomCarousel.slick('slickPlay');
        $newsroomCarousel.slick('slickNext');
        $btnPlayNewsroom.removeClass('icon-play-circle').addClass('icon-pause-circle');
        newsroomCarouselAutoplay = true;
      }
      else {
        $newsroomCarousel.slick('slickPause');
        $btnPlayNewsroom.removeClass('icon-pause-circle').addClass('icon-play-circle');
        newsroomCarouselAutoplay = false;
      }
    })

    // social
    let $socialCarousel = $('.social-carousel', $st),
      $btnPlaySocial = $('.btn-play-social', $st),
      socialCarouselAutoplay = false
    ;
    $socialCarousel.slick({
      adaptiveHeight: true,
      autoplay: socialCarouselAutoplay,
      speed: 600,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      dots: false,
      arrows: true,
      appendArrows: $('.social-carousel-nav', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left-circle"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right-circle"></button>',
      slidesToShow: 2,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 2561,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });
    $btnPlaySocial.on('click', e => {
      if ( !socialCarouselAutoplay ) {
        $socialCarousel.slick('slickPlay');
        $socialCarousel.slick('slickNext');
        $btnPlaySocial.removeClass('icon-play-circle').addClass('icon-pause-circle');
        socialCarouselAutoplay = true;
      }
      else {
        $socialCarousel.slick('slickPause');
        $btnPlaySocial.removeClass('icon-pause-circle').addClass('icon-play-circle');
        socialCarouselAutoplay = false;
      }
    })

    // testimonial
    let $testimonialCarousel = $('.testimonial-carousel', $st);
    $testimonialCarousel.slick({
      adaptiveHeight: true,
      autoplay: false,
      speed: 600,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      dots: false,
      fade: true,
      arrows: true,
      appendArrows: $('.testimonial-carousel-nav', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left-circle"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right-circle"></button>',
      slidesToShow: 1,
      slidesToScroll: 1,
    });

    // video block
    let $vidBlock = $('.video-block', $st),
      $vidBtn = $('a', $vidBlock),
      videoSrc = $vidBlock.data('vidsrc');

    $vidBtn.on('click', e => {
      $vidBlock.html('<div class="embed-responsive embed-responsive-16by9" style="height:100%;"><iframe src="' + videoSrc + '" frameborder="0" allow="autoplay" playinline="playinline" allowfullscreen></iframe></div>');
    })
  })
})
