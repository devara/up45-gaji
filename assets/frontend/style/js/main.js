  $("#slide-show").owlCarousel({
      animateOut: 'lightSpeedOut',
      animateIn: 'lightSpeedIn',
      items:1,
      loop: true,
      autoplay:true,
      autoplayTimeout:4000,
      autoplayHoverPause:true,
      smartSpeed:600,
      dots: false,
      nav:true,
      navText: false
  });

  $("#slide-berita").owlCarousel({
      items:3,
      margin: 10,
      loop: true,
      autoplay:true,
      autoPlayTimeout:3000,
      autoplayHoverPause:true,
      dots: false,
      nav:false,
      navText: false,
      responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
  });