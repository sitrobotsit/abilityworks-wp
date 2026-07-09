// import tippy from 'tippy.js';
import imagesLoaded from 'imagesloaded';

imagesLoaded.makeJQueryPlugin( jQuery );

jQuery($ => {
  let $body = $('body'), $win = $(window),
    $header = $('#header'), $main = $('#main'), $footer = $('#footer')
  ;

  // let SetMainPaddingTop = () => {
  //   $main.css('padding-top', $header.height() + 'px');
  // }
  // SetMainPaddingTop();
  // $win.on('resize', SetMainPaddingTop);

  $body.on('click', '#menuToggle', e => {
    $body.toggleClass('nav-open')
    if ( !$body.hasClass('nav-open') ) {
      $header.removeClass('search-open')
    }
  })
  .on('click', '.sub-menu-toggle', e => {
    let $a = $(e.currentTarget),
      $li = $a.parent(),
      $subMenu = $('.sub-menu', $li)
    ;
    $a.toggleClass('rotated');
    $subMenu.slideToggle();
  })
  .on('click', '.toggle-search', e => {
    $header.toggleClass('search-open')
    if ( $header.hasClass('search-open') ) {
      $('#input-search').focus();
    }
  })
  .on('blur', '#input-search', e => {
    setTimeout(() => {
      $header.removeClass('search-open')
    }, 400)
  })
  .on('click', '.scroll-to', e => {
    e.preventDefault();

    let $a = $(e.currentTarget),
      selector = $a.attr('href'),
      $elm = $(selector)
    ;

    if ( $elm.length > 0 ) {
      $('html,body').animate({
        scrollTop: $elm.offset().top - $('#header').height()
      }, 800);
    }
  })
  .on('click', '.faq .q a', e => {
    let $q = $(e.currentTarget),
      $faq = $q.parents('.faq'),
      $wrapper = $faq.parent(),
      $a = $('.a', $faq);

    $('.faq .a', $wrapper).not($a).slideUp();
    $('.faq', $wrapper).not($faq).removeClass('reveal');

    $faq.toggleClass('reveal');
    $a.slideToggle(400);
  })
  .on('click', '.more-less-link a', e => {
    let $a = $(e.currentTarget), isMore = $a.html()=='READ MORE',
      $more_less = $a.parents('.more-less'),
      $parentCarousel = $more_less.parents('.slides'),
      $ct = $more_less.find('.more-less-content');

    $a.html( isMore ? 'CLICK TO CLOSE' : 'READ MORE' ).toggleClass('less');

    $ct.slideToggle(600, () => {
      if ( $parentCarousel.length > 0 ) {
        $parentCarousel.slick('setPosition');
      }
    });
  })
  .on('click', '.image-video-play', e => {
    let $a = $(e.currentTarget), width = $a.width(), height = $a.height(), videoSrc = $a.attr('rel');

    let iframeHTML = '<div style="width:' + width + 'px;height:' + height + 'px;margin-left:auto;margin-right:auto;"><div class="video-wrapper">\
      <iframe src="' + videoSrc + '" frameborder="0" allow="autoplay" allowfullscreen></iframe>\
    </div></div>';

    $a.replaceWith(iframeHTML);
  })

  // tippy('.tippy a, a.tippy', {
  //   placement: 'auto',
  //   trigger: 'mouseenter focus',
  // });

  // tippy('img.tippy', {
  //   content: reference => reference.getAttribute('title'),
  //   placement: 'top',
  //   theme: 'pale-aqua',
  //   zIndex: 200
  // })

  // $(document).magnificPopup({
  //   delegate: '.mfp-img',
  //   mainClass: 'mfp-zoom',
  //   type: 'image',
  //   gallery: {
  //     enabled: true
  //   }
  // })

  // anchor
  if ( window.location.hash ) {
    let hash = window.location.hash;
    if ( hash.indexOf('#st-') === 0 ) {
      let elmId = hash.substr(4), $anchor = $('#' + elmId);
      if ( $anchor.length > 0 ) {
        setTimeout(() => {
          $('html,body').animate({
            scrollTop: $anchor.offset().top - $('#header').height()
          }, 700);
        }, 1000)
      }
    }
  }

  let caSpacer = () => {
    $('.ca-spacer').each((index, t) => {
      let $spacer = $(t),
        sm = $spacer.data('sm'),
        md = $spacer.data('md'),
        lg = $spacer.data('lg'),
        winW = $win.width()
      ;

      if ( winW < 768 ) {
        $spacer.height(sm);
      }
      else if ( 768 <= winW && winW < 1024 ) {
        $spacer.height(md);
      }
      else {
        $spacer.height(lg);
      }
    })
  }
  caSpacer();
  $win.on('resize', caSpacer);

  let onWindowScroll = () => {
    let winScrollTop = $win.scrollTop();
    if ( winScrollTop > 86 ) {
      $body.addClass('header-scrolled');
    }
    else {
      $body.removeClass('header-scrolled');
    }
  }
  onWindowScroll();
  $win.on('scroll', onWindowScroll);

  // footer
  let $logosSlider = $('#logos-slider');
  if ( $logosSlider.length > 0 ) {
    $logosSlider.imagesLoaded(() => {
      $logosSlider.slick({
        adaptiveHeight: false,
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 800,
        infinite: true,
        variableWidth: true,
        slidesToScroll: 1,
        centerMode: false,
        dots: false,
        arrows: false,
        appendArrows: '.logos-carousel-arrows',
        prevArrow: '<button type="button" class="slick-prev icon-caret-left-circle"></button>',
        nextArrow: '<button type="button" class="slick-next icon-caret-right-circle"></button>',
        responsive: [
          {
            breakpoint: 768,
            settings: {
              autoplay: true,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 1,
              arrows: true,
            }
          },
        ]
      })
    })
  }
  // $('.faq-carousel').slick({
  //   adaptiveHeight: false,
  //   autoplay: false,
  //   autoplaySpeed: 7000,
  //   infinite: true,
  //   dots: false,
  //   arrows: true,
  //   appendArrows: '.faq-carousel-arrows',
  //   prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
  //   nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
  // })
  // .on('beforeChange', () => {
  //   $('.faq-carousel .faq .a').slideUp();
  // })
})
