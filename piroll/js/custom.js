var page = 2;
jQuery(function ($) {
  function load_js() {
    var head = document.getElementsByTagName("head")[0];
    var script = document.createElement("script");
    script.src = "wp-content/themes/piroll/js/jquery.magnific-popup.min.js?ver=5.4.1";
    head.appendChild(script);

    $(".link").magnificPopup({
      type: "image",
      closeOnContentClick: true,
      mainClass: "mfp-img-mobile",
      image: {
        verticalFit: true,
      },
    });

    console.log("1");
  }

  $("body").on("click", ".loadmore", function () {
    load_js();
    var data = {
      action: "load_posts_by_ajax",
      page: page,
      security: blog.security,
    };

    $.post(blog.ajaxurl, data, function (response) {
      if ($.trim(response) != "") {
        $(".blog-posts").append(response);
        page++;
      } else {
        $(".loadmore").hide();
      }
    });
  });
});
