jQuery($ => {
  let $win = $(window), $header = $('#header'),
    $notificationBar = $('.easy-notification-bar');

  $('.st-video-banner').each((index, t) => {
    let $t = $(t), $btnPlay = $('.btn-play', $t),
      video = document.getElementById('video-banner')
    ;

    let fixButton = () => {
      $btnPlay.css('bottom', '')

      if ($win.width() <= 768 && $notificationBar.is(':visible') ) {
        $btnPlay.css('bottom', '90px');
      }
    }
    fixButton()
    $win.on('resize', fixButton);

    $('#btn-video-banner').show().addClass('icon-pause-circle')
    // video.addEventListener('loadeddata', e => {
    //   if ( video.readyState >= 3 ) {
    //     $('#btn-video-banner').show().addClass('icon-pause-circle')
    //   }
    // });

    $btnPlay.on('click', e => {
      if ( video.paused ) {
        video.play()
        $btnPlay.removeClass('icon-play-circle')
        $btnPlay.addClass('icon-pause-circle')
      }
      else {
        video.pause()
        $btnPlay.addClass('icon-play-circle')
        $btnPlay.removeClass('icon-pause-circle')
      }
    })
  })
})
