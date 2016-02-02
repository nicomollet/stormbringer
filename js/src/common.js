$(document).ready(function () {

  // Console debug
  if (typeof window.console === 'undefined' || stormbringer_config.ENV != 'development') {
    window.console = {
      log: function () {
      },
      warn: function () {
      },
      error: function () {
      },
      trace: function () {
      }
    }
  }

  // Add Modernizr test: iOS detection
  if (typeof Modernizr == 'object') {
    Modernizr.addTest('ios', function () {
      return navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false
    });
  }

  // Contact Form default place holds WPCF7
  $('.wpcf7-text, .wpcf7-textarea').each(function(){
    $(this).attr('placeholder',$(this).val());
    if($(this).text()!="")$(this).attr('placeholder',$(this).text());
    $(this).val("");
  });

  // Applies placeholder attribute behavior in web browsers that don't support it
  if (!('placeholder' in document.createElement('input'))) {

    $('input[placeholder]').each(function() {
      $(this).data('originalText', $(this).val()).data('placeholder', $(this).attr("placeholder"));

      if (!$(this).data('originalText').length)
        $(this).val($(this).data("placeholder")).addClass('placeholder');

      $(this)
      .bind("focus", function () {
        if ($(this).val() === $(this).data('placeholder'))
          $(this).val("").removeClass('placeholder');
      })
      .bind("blur", function () {
        if (!$(this).val().length)
          $(this).val($(this).data('placeholder')).addClass('placeholder');
      })
      .parents("form").bind("submit", function () {
        // Empties the placeholder text at form submit if it hasn't changed
        if ($(this).val() === $(this).data('placeholder'))
          $(this).val("").removeClass('placeholder');
      });
    });
  }

  // Open external links in a new window or tab
  $('a[rel$="external"]').each(function() {
    $(this).attr('target', "_blank");
  });
  $("a[href^='http:']:not([href*='" + window.location.host + "'])").each(function() {
    $(this).attr("target", "_blank");
    $(this).attr("rel", "external");
  });

  // Adds last and first classes to UL lists
  $("ul li:first-child").addClass("first");
  $("ul li:last-child").addClass("last");

  // Gravity Forms disabled fields
  $('input[data-disabled="1"],textarea[data-disabled="1"]').each(function (e) {
    if($(this).val()!='')
      $(this).attr('readonly','readonly');
  });

  // Email obfuscation
  $("span.cryptemail").each(function(){
    var spt = $(this);
    var at = / at /;
    var dot = / dot /g;
    var addr = $(spt).attr("title").replace(at,"@").replace(dot,".");
    $(spt).after('<a class="cryptemail" href="mailto:'+addr+'" alt="'+$(spt).attr("title")+'">'+addr+'</a>')
      .hover(function(){window.status="Contact";}, function(){window.status="";});
    $(spt).remove();
  });

  // Bootstrap Selectpicker
  if (typeof($.fn.selectpicker) =='function') {
    $('select').removeClass('form-control').selectpicker();
  }

  // Modal Gallery Defaults
  if (typeof($.fn.ekkoLightbox) == 'function') {
    $.fn.ekkoLightbox.defaults = {
      gallery_parent_selector: '*:not(.row)',
      left_arrow_class: '.carousel-control .left .glyphicon .glyphicon-chevron-left',
      right_arrow_class: '.carousel-control .right .glyphicon .glyphicon-chevron-right',
      directional_arrows: true,
      type: null,
      always_show_close: true,
      onShow: function() {},
      onShown: function() {},
      onHide: function() {},
      onHidden: function() {}
    };
  }

  // Datepicker defaults
  if (typeof($.fn.datepicker) == 'function') {
    if (stormbringer_config.THEME_LANG != '')$.fn.datepicker.defaults.language = stormbringer_config.THEME_LANG;
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    $.fn.datepicker.defaults.startDate = now;
    $.fn.datepicker.defaults.format = 'dd-mm-yyyy';
    $.fn.datepicker.defaults.autoclose = true;
    $.fn.datepicker.defaults.todayBtn = true;
    $.fn.datepicker.defaults.todayHighlight = true;
    //$('.datepicker-input').datepicker({});
  }

  // Carousel swipe
  if (Modernizr.touch && typeof($.fn.swipe) == 'function') {
    $('.carousel-control').remove();
    $('.carousel').swipe({
      swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
        if (direction == 'left') $(this).carousel('next');
        if (direction == 'right') $(this).carousel('prev');
      },
      allowPageScroll: "vertical"
    });
  }


  // Datepicker defaults
  if (typeof($.fn.owlCarousel) == 'function') {

    $('.owl-carousel').each( function() {
      var $owlcarousel = $(this);
      console.log('responsive:'+{
            0: {
              items: 1,
            },
            600: {
              items: 2,
              slideBy: 2,
            },
            1000: {
              items: 4,
              slideBy: 4,
            }
          });
      $owlcarousel.owlCarousel({
        loop: $owlcarousel.data('loop'),
        center: $owlcarousel.data('center'),
        nav: $owlcarousel.data('controls'),
        dots: $owlcarousel.data('indicators'),
        autoplay: $owlcarousel.data('autoplay'),
        autoplayTimeout: $owlcarousel.data('timeout'),
        items: $owlcarousel.data('items'),
        slideBy: $owlcarousel.data('slideby'),
        loadedClass: 'carousel owl-loaded',
        stageOuterClass: 'carousel-inner',
        stageClass: 'carousel-stage',
        navContainerClass: 'carousel-controls',
        navClass: [
          'left carousel-control ',
          'right carousel-control'
        ],
        navText: [
          '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
          '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
        ],
        dotsClass: 'carousel-indicators', // owl-dots
        dotClass: 'dot',
        responsive: {
          0: {
            items: 1,
          },
          600: {
            items: 2,
            slideBy: 2,
          },
          1000: {
            items: 4,
            slideBy: 4,
          }
        }
      });
    });
  }

});
