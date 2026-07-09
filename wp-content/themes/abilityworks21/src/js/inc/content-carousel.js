jQuery($ => {
  $('.st-content-carousel').each((index, st) => {
    let $st = $(st), $imagesCarousel = $('.images-carousel', $st),
      $carouselArrows = $('.carousel-arrows', $st);

    $imagesCarousel.slick({
      adaptiveHeight: true,
      autoplay: false,
      autoplaySpeed: 7000,
      infinite: false,
      dots: false,
      arrows: true,
      appendArrows: $carouselArrows,
      prevArrow: '<button type="button" class="slick-prev icon-caret-left"></button>',
      nextArrow: '<button type="button" class="slick-next icon-caret-right"></button>',
    });
  })
})
