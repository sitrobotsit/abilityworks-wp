jQuery($ => {
  let $header = $('#header');

  $('.st-list-videos').each((idx, st) => {
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

    $('.videos-carousel', $st).slick({
      adaptiveHeight: false,
      autoplay: false,
      speed: 400,
      cssEase: 'ease-out',
      autoplaySpeed: 7000,
      infinite: true,
      fade: false,
      dots: true,
      appendDots: $('.videos-carousel-dots', $st),
      arrows: true,
      appendArrows: $('.videos-carousel-navs', $st),
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

  $('body').on('click', '.play-video-onpage', e => {
    let $a = $(e.currentTarget), vid = $a.attr('rel'),
      $stHlVideo = $('.st-highlighted-video'),
      $formFilter = $('.form-filter-video')
    ;

    $formFilter.find('[name="vid"]').val(vid)

    $stHlVideo.block({
      message: 'Loading video...',
      overlayCSS: {
        backgroundColor: '#196281',
        opacity: .2
      },
      css: {
        color: '#6f6f6e',
        border: '2px solid #6f6f6e',
      }
    });

    $('html,body').animate({
      scrollTop: $stHlVideo.offset().top - $header.outerHeight() - 50
    }, 600);

    $.get(pxaObj.ajaxurl, {
      action: 'pxa_get_video_html',
      vid,
    }, rs => {
      $stHlVideo.html( rs );
      $stHlVideo.unblock();

      let params = $formFilter.serializeArray();
      let s = $.param(params);
      window.history.replaceState(null, null, s.length ? '?' + s : '');
    })
  })
})
