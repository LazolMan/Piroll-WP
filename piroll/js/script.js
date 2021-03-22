jQuery(function ($) {
  "use strict";

  var sections = $("section");
  var nav = $("#header_id");
  var nav_height = nav.outerHeight();

  $(window).on("scroll", function () {
    var cur_pos = $(this).scrollTop();

    sections.each(function () {
      var top = $(this).offset().top - nav_height,
        bottom = top + $(this).outerHeight();

      if (cur_pos >= top && cur_pos <= bottom) {
        nav.find("a").removeClass("active");
        sections.removeClass("active");

        $(this).addClass("active");
        nav.find('a[href="#' + $(this).attr("id") + '"]').addClass("active");
      }
    });
  });

  nav.find("a").on("click", function () {
    var $el = $(this),
      id = $el.attr("href");

    $("html, body").animate(
      {
        scrollTop: $(id).offset().top - nav_height,
      },
      750
    );

    return false;
  });

  window.onscroll = function () {
    fixHeader();
  };

  var header = document.getElementById("header_id");
  var sticky = header.offsetTop;

  function fixHeader() {
    if (window.pageYOffset > sticky) {
      header.classList.add("sticky");
    } else {
      header.classList.remove("sticky");
    }
  }

  if ($(".open_video").length) {
    $(".open_video").magnificPopup({
      disableOn: 700,
      type: "iframe",
      mainClass: "mfp-fade",
      removalDelay: 160,
      preloader: false,

      fixedContentPos: false,
    });
  }

  $(".link").on("click", function (e) {
    e.preventDefault();
    $(".link")
      .magnificPopup({
        type: "image",
        closeOnContentClick: true,
        closeBtnInside: true,
        mainClass: "mfp-with-zoom mfp-img-mobile",
        image: {
          verticalFit: true,
        },
      })
      .magnificPopup("open");
  });

  if ($(".reviews_slider").length) {
    $(".reviews_slider").slick({
      arrows: false,
      dots: true,
      autoplay: true,
      autoplaySpeed: 5000,
    });
  }
});
