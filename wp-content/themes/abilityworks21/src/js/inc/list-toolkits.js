jQuery($ => {
  $('.st-list-toolkits').each((idx, st) => {
    let $st = $(st);

    $('.toolkits-carousel', $st).slick({
      adaptiveHeight: false,
      autoplay: false,
      speed: 400,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      fade: false,
      dots: true,
      appendDots: $('.toolkits-carousel-dots', $st),
      arrows: true,
      appendArrows: $('.toolkits-carousel-navs', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
      slidesToShow: 2,
      slidesToScroll: 1,
      centerMode: false,
      variableWidth: true,
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
