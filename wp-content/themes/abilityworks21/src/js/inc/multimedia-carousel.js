jQuery($ => {
  $('.st-multimedia-carousel').each((idx, st) => {
    let $st = $(st);

    $('.media-items', $st).slick({
      adaptiveHeight: false,
      autoplay: false,
      speed: 400,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      fade: false,
      dots: true,
      appendDots: $('.items-carousel-dots', $st),
      arrows: true,
      appendArrows: $('.items-carousel-navs', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            centerMode: false,
            variableWidth: true,
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 768,
          settings: {
            centerMode: true,
            variableWidth: false,
            centerPadding: 0,
            slidesToShow: 1,
          }
        }
      ]
    })
  })
})
