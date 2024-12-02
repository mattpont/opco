// Add your custom JS here.
AOS.init({
  easing: 'ease-out',
  once: true
});

(function(){
    // hide header on scroll
  
    var doc = document.documentElement;
    var w = window;
  
    var prevScroll = w.scrollY || doc.scrollTop;
    var curScroll;
    var direction = 0;
    var prevDirection = 0;
  
    var header = document.getElementById('wrapper-navbar');
  
    var checkScroll = function() {
  
      /*
      ** Find the direction of scroll
      ** 0 - initial, 1 - up, 2 - down
      */
  
      curScroll = w.scrollY || doc.scrollTop;
      if (curScroll > prevScroll) { 
        //scrolled up
        direction = 2;
      }
      else if (curScroll < prevScroll) { 
        //scrolled down
        direction = 1;
      }
  
      if (direction !== prevDirection) {
        toggleHeader(direction, curScroll);
      }
  
      prevScroll = curScroll;
    };
  
    var toggleHeader = function(direction, curScroll) {
      if (direction === 2 && curScroll > 125) { 
  
        //replace 52 with the height of your header in px
        if (!document.getElementById('navbar').classList.contains("show")) {
            header.classList.add('hide');
            prevDirection = direction;
        }
      }
      else if (direction === 1) {
        header.classList.remove('hide');
        prevDirection = direction;
      }
    };
  
    window.addEventListener('scroll', checkScroll);
  
      // header background
  
    $(document).on('scroll', function () {
      var $nav = $("#navbar");
      // $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height() );
      if (!$('#primaryNav').hasClass('show')) {
        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height() );
      }
      $(".dropdown-menu").removeClass('show');
      $(".dropdown-toggle").removeClass('show');
      $(".dropdown-toggle").blur();
    });
  
    $('#navToggle').on('click', function(){
      var $nav = $("#navbar");
      $nav.toggleClass('navdark');
    });
  
    // hide menu on click outside
    $("body").click(function (event) {
      var navigation = $(event.target).parents(".navbar").length;
      if(!navigation) {
          $(".navbar .navbar-collapse").collapse("hide");
      }
    });
  
})(jQuery);
  