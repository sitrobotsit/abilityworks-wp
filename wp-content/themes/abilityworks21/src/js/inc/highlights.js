jQuery($ => {
  $('.st-highlights').each((idx, st) => {
    let $st = $(st), autoScroll = ($st.data('autoscroll')=='yes');

    $('.highlights-carousel', $st).slick({
      adaptiveHeight: false,
      autoplay: autoScroll,
      speed: 800,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      dots: true,
      appendDots: $('.highlights-carousel-dots', $st),
      arrows: true,
      appendArrows: $('.highlights-carousel-navs', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
      slidesToShow: 2,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            centerMode: false,
            variableWidth: true,
            slidesToShow: 1,
          }
        },
        {
          breakpoint: 1024,
          settings: {
            centerMode: true,
            centerPadding: 0,
            slidesToShow: 1,
          }
        }
      ]
    })
  })
})
