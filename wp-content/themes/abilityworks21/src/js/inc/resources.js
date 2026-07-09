jQuery($ => {
  $('.st-resources').each((idx, st) => {
    let $st = $(st), $header = $('#header'),
      $filterForm = $('#filterForm'),
      $toggleOpts = $('.toggle-opts', $st),
      $filterOpts = $('.filter-opts', $st),
      $kwToggler = $('.kw-toggler', $st),
      $phaseSearch = $('.phase-search', $st),
      $phaseFilter = $('.phase-filter', $st),
      $kw = $('#kw', $st),
      $kwSearch = $('.kw-search', $st),
      $kwClose = $('.kw-close', $st),
      $toggleAdv = $('.toggle-adv', $st),
      $advWrapper = $('.adv-wrapper', $st),
      isResources = ($st.data('is_resources') == 'yes'),
      isCarousel = ($st.data('carousel') == 'yes'),
      carouselHidden = false,
      $topics = $('#topics', $st),
      $cats = $('#cats', $st),
      $paged = $('#paged', $st),
      $resourcesList = $('.resources-list', $st),
      $resourcesListPaging = $('.resources-list-paging', $st)
    ;

    let generateURL = () => {
      let params = $filterForm.serializeArray();
      let s = $.param(params);
      // console.log(params)
      // console.log(s)
      window.history.replaceState(null, null, s.length ? '?' + s : '');
    };

    let getResources = (scrollTop) => {
      if ( scrollTop ) {
        $('html,body').animate({
          scrollTop: $st.offset().top - $header.outerHeight()
        }, 600);
      }

      $filterForm.submit();
    }

    $filterForm.on('submit', e => {
      e.preventDefault();
      $st.block({
        message: 'Loading resources...',
        overlayCSS: {
          backgroundColor: '#196281',
          opacity: .2
        },
        css: {
          color: '#6f6f6e',
          border: '2px solid #6f6f6e',
        }
      });
      $.get($filterForm.attr('action'), $filterForm.serializeArray(), rs => {
        if ( isCarousel && !carouselHidden ) {
          $('.resources-carousel, .resources-carousel-btm', $st).remove();
          carouselHidden = true;
        }

        $resourcesList.html(rs.html);
        $resourcesListPaging.html(rs.paging);

        if ( isResources ) {
          generateURL();
        }

        $st.unblock();
      }, 'json');
    })

    if ( isCarousel ) {
      $('.resources-carousel', $st).slick({
        adaptiveHeight: false,
        autoplay: false,
        speed: 600,
        cssEase: 'ease-out',
        infinite: true,
        dots: true,
        appendDots: $('.resources-carousel-dots', $st),
        arrows: true,
        appendArrows: $('.resources-carousel-navs', $st),
        prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
        nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              centerMode: false,
              slidesToShow: 2,
              slidesToScroll: 1,
              variableWidth: true,
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
    }
    else {
      getResources(false);
    }

    $('body').on('click', '.load-more', e => {
      let $btn = $(e.currentTarget);
      $paged.val($btn.attr('rel'));
      getResources(true);
    })
    .on('click', '.reset-search', e => {
      $('[name="phases[]"],[name="tags[]"]', $st).prop('checked', false);
      $('#kw', $st).val('');

      $('.slchk', $st).find('option:selected').each((idx, opt) => {
        $(opt).prop('selected', false);
      })
      .trigger('change.multiselect')

      $paged.val(1);

      getResources();
    })

    $('.slchk', $st).multiSelect({
      noneText: 'Please select...',
    })
    .on('change', e => {
      let $slb = $(e.currentTarget);

      $('.slchk', $st).not($slb).find('option:selected').each((idx, opt) => {
        $(opt).prop('selected', false);
      })
      .trigger('change.multiselect')

      $paged.val(1);
      getResources();
    });

    $('[name="phases[]"]', $st).on('change', e => {
      $paged.val(1);
      getResources();
    })
    $('[name="tags[]"]', $st).on('change', e => {
      $paged.val(1);
      getResources();
    })

    $('#resetTags', $st).click(e => {
      $('[name="tags[]"]', $st).prop('checked', false);

      $paged.val(1);
      getResources();
    })

    $toggleOpts.click(() => {
      $filterOpts.slideToggle();
    })

    $kwToggler.click(() => {
      $phaseSearch.toggleClass('active-kw');
    })
    $kwClose.click(() => {
      $phaseSearch.toggleClass('active-kw');
    })

    $toggleAdv.click(() => {
      $advWrapper.toggle();
      $toggleAdv.toggleClass('active');
    })
  })
})
