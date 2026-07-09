jQuery($ => {
  $('.st-steps-carousel').each((idx, st) => {
    let $st = $(st), aInfoTexts = [],
      $header = $('#header'),
      $steps = $('.steps', $st),
      $arrowsInfo = $('.steps-arrows-info', $st);

    $('.info-text', $st).each((index, t) => {
      aInfoTexts.push( $(t).html() );
    })

    $('.steps-carousel', $st).slick({
      adaptiveHeight: true,
      autoplay: false,
      speed: 400,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      fade: false,
      dots: false,
      arrows: true,
      appendArrows: $('.steps-arrows-container', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
      slidesToShow: 1,
      slidesToScroll: 1,
    })
    .on('beforeChange', (e, slick, currentSlide, nextSlide) => {
      $arrowsInfo.html(aInfoTexts[nextSlide]);
    })
    .on('afterChange', (e, slick, currentSlide) => {
      $('li', $steps).removeClass('active');
      $('.step-' + currentSlide, $steps).addClass('active');
      $('html,body').animate({
        scrollTop: $steps.offset().top - $header.height() - 30
      }, 600);
    })

    $('.show-slide', $st).on('click', e => {
      let $a = $(e.currentTarget), slideIndex = $a.attr('rel');
      $('.steps-carousel', $st).slick('slickGoTo', slideIndex);
    })
  })
})
