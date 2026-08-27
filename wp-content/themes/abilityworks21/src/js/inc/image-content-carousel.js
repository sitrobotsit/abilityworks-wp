jQuery($ => {
  $('.st-image-content-carousel').each((idx, st) => {
    let $st = $(st);

    $('.items-carousel', $st).slick({
      adaptiveHeight: false,
      autoplay: false,
      speed: 400,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: false,
      fade: false,
      dots: true,
      appendDots: $('.items-carousel-dots', $st),
      arrows: true,
      appendArrows: $('.items-carousel-navs', $st),
      prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
      slidesToShow: 3,
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

  $('body').on('click', '.img-ct-video-play', e => {
    let $a = $(e.currentTarget), $item = $a.parents('.thumb'), videoSrc = $a.attr('rel'), height = $a.height();

    $item.addClass('active')
      .append('<div class="video-wrapper" style="height:' + height + 'px;"><iframe src="' + videoSrc + '" frameborder="0" allow="autoplay" allowfullscreen></iframe></div>');

    $('.items-carousel').slick('setPosition');
  })
})
