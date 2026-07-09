jQuery($ => {
  $('.st-image-carousel').each((idx, st) => {
    let $st = $(st), aInfoTexts = [], $arrowsInfo = $('.arrows-info', $st);

    $('.info-text', $st).each((index, t) => {
      aInfoTexts.push( $(t).html() );
    })

    $('.items-carousel', $st).slick({
      adaptiveHeight: false,
      autoplay: false,
      speed: 400,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      fade: false,
      dots: false,
      arrows: true,
      appendArrows: $('.arrows-container', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            adaptiveHeight: true,
          }
        }
      ]
    })
    .on('beforeChange', (e, slick, currentSlide, nextSlide) => {
      $arrowsInfo.html(aInfoTexts[nextSlide]);
    })

  })
})
