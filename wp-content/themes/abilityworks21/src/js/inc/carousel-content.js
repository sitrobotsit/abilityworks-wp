jQuery($ => {
  $('.st-carousel-content').each((idx, st) => {
    let $st = $(st);

    $('.items-carousel', $st).slick({
      adaptiveHeight: false,
      autoplay: false,
      speed: 800,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: false,
      dots: true,
      appendDots: $('.items-carousel-dots', $st),
      arrows: true,
      appendArrows: $('.items-carousel-navs', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            centerMode: false,
            variableWidth: true,
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 1024,
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
            centerPadding: 0,
            slidesToShow: 1,
          }
        }
      ]
    })
  });
})
