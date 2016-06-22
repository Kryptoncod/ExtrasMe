var elements = [];
var currentscroll = 0;
$(function() {

if (('.index-side-nav').length) {

   elements = refresh_side_nav_elements();
   refresh_current_side_nav_element(null);
   //prevent_scrolling();

   $('.index-side-nav a').click(function(e) {
      e.preventDefault();
      var target = $(e.target);
      var element = $(target.attr('href'));

      scroll_to_element(element);
      change_active_element(target);
   });


   /*$(window).scroll(function(e){
      var current = $('.index-side-nav a.active').attr('href');
      var next = 0;

      currentscroll =

      elements.forEach(function(item, id) {
         if (item == current) {
            next = id+1;
         }
      });

      if (next != elements.length || next != 0) {
         var element = elements[next];

         scroll_to_element($(element));
         change_active_element($('.index-side-nav a[href=' + element + ']'));
      }

   });*/

   $(window).scroll(Foundation.utils.throttle(refresh_current_side_nav_element, 200));

}

});

function refresh_current_side_nav_element(e) {
   var window_height = window.innerHeight;
   var window_offset = $(window).scrollTop();
   var window_offset_middle = window_offset + window_height/2;

   var active_element: any = false;

   var offsets = $(elements).map(function(id, item) {
      var top_offset = $(item).offset().top;
      return {
         hash: item,
         top_offset: top_offset
      };
   });

   offsets.each(function(id, item: any) {
      if (window_offset_middle >= item.top_offset) {
         active_element = item;
      }
   });

   $('.index-side-nav a.active').removeClass('active');

   if (active_element) {
      $('.index-side-nav a[href="' + active_element.hash + '"]').addClass('active');
   }
}

function scroll_to_element(element) {
   if (element.length) {
      $(window).scrollTop(element.offset().top-55);
   }
}

function change_active_element(element) {
   if (element.length) {
      $('.index-side-nav a.active').removeClass('active');
      element.addClass('active');
   }
}

function refresh_side_nav_elements() {
   var elems = [];
   $('.index-side-nav a').each(function() {
      elems.push($(this).attr('href'));
   });
   return elems;
}

function prevent_scrolling() {
   $('body').css('overflow-y', 'hidden');
}
