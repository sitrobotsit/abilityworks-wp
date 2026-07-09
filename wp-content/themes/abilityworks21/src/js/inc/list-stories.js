jQuery($ => {
  let $header = $('#header');

  $('.st-list-stories').each((idx, st) => {
    let $st = $(st);

    if ( $st.data('scroll-here') == 'yes' ) {
      $('html,body').animate({
        scrollTop: $st.offset().top - $header.outerHeight()
      }, 800);
    }

    $('.slchk', $st).multiSelect({
      noneText: 'Please select...',
    })
    .on('change', e => {
      let $slb = $(e.currentTarget);

      $slb.closest('form').submit();
    });

    $('.stories-carousel', $st).slick({
      adaptiveHeight: false,
      autoplay: false,
      speed: 400,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      fade: false,
      dots: true,
      appendDots: $('.stories-carousel-dots', $st),
      arrows: true,
      appendArrows: $('.stories-carousel-navs', $st),
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
