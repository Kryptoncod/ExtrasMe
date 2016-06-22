$('.top-bar .signin-button-parent .signin-button').on('click', function(e) {
   e.preventDefault();
   $('.top-bar .top-bar-section .signin-section').removeClass('closed');
   $('.top-bar .signin-button-parent').addClass('hidden');
});

$('.top-bar .top-bar-section .signin-section .exit-button').on('click', function(e) {
   e.preventDefault();
   $('.top-bar .top-bar-section .signin-section').addClass('closed');
   setTimeout(function() {
      $('.top-bar .signin-button-parent').removeClass('hidden');
   }, 200);
});
