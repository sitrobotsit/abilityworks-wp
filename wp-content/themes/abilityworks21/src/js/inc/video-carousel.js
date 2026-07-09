jQuery($ => {
  $('.st-video-carousel').each((idx, st) => {
    let $st = $(st), aInfoTexts = [],
      $descArrowsInfo = $('.desc-arrows-info', $st),
      $videoArrowsInfo = $('.video-arrows-info', $st)
    ;

    $('.info-text', $st).each((index, t) => {
      aInfoTexts.push( $(t).html() );
    })

    $('.desc-carousel', $st).slick({
      adaptiveHeight: false,
      autoplay: false,
      speed: 400,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      fade: true,
      dots: false,
      arrows: true,
      appendArrows: $('.desc-arrows-container', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
      slidesToShow: 1,
      slidesToScroll: 1,
      asNavFor: '.videos-carousel',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            adaptiveHeight: true,
            fade: false,
          }
        }
      ]
    })
    .on('beforeChange', (e, slick, currentSlide, nextSlide) => {
      $descArrowsInfo.html(aInfoTexts[nextSlide]);
    })

    $('.videos-carousel', $st).slick({
      adaptiveHeight: false,
      autoplay: false,
      speed: 400,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      fade: true,
      dots: false,
      arrows: true,
      appendArrows: $('.video-arrows-container', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
      slidesToShow: 1,
      slidesToScroll: 1,
      asNavFor: '.desc-carousel',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            adaptiveHeight: false,
          }
        }
      ]
    })
    .on('beforeChange', (e, slick, currentSlide, nextSlide) => {
      $videoArrowsInfo.html(aInfoTexts[nextSlide]);

      let $item = $('.item-' + currentSlide, $st);

      $item.removeClass('active').find('.video-wrapper').remove();

      $('.videos-carousel', $st).slick('setPosition');
    })
  })

  $('body').on('click', '.video-carousel-play', e => {
    let $a = $(e.currentTarget), $item = $a.parents('.item'), videoSrc = $item.data('vidsrc'), height = $item.height();

    $item.addClass('active')
      .append('<div class="video-wrapper" style="height:' + height + 'px;"><iframe src="' + videoSrc + '" frameborder="0" allow="autoplay" allowfullscreen></iframe></div>');

    $('.videos-carousel').slick('setPosition');
  })
})
