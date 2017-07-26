jQuery(function($) { // DOM is now ready and jQuery's $ alias sandboxed


  // Navbar stuck on scrolltop
  if($('#navigation').hasClass('navbar-stuckonscrolltop')){
    var lastScrollTop = 0;
    var headerHeight = $('#navigation').height() + $('#header').height() + $('#header-above').height() + $('#header-below').height();
    var navHeight = $('#navigation').height();
    $(window).scroll(function(event){
      var st = $(this).scrollTop();
      if (st > headerHeight && st > lastScrollTop){
        $('#navigation').addClass('navbar-outofview').addClass('navbar-stuck');
      }
      if(st <= (headerHeight)){
        $('#navigation').removeClass('navbar-stuck');
      }
      if (st > lastScrollTop){ // going down
        //$('#navigation').addClass('navbar-outofview'); // nico 2017/05/23 testing without this line to check behaviour
      } else { // going up
        $('#navigation').removeClass('navbar-outofview'); //up
      }
      lastScrollTop = st;
    });
  }


  // Modernizr
  if (typeof Modernizr == 'object') {

    // Modernizr: Objectfit fallback
    if ( ! Modernizr.objectfit ) {
      $('.objectfit').each(function () {
        var $container = $(this),
          imgUrl = $container.find('img').prop('src');
        if (imgUrl) {
          $container
            .css('backgroundImage', 'url(' + imgUrl + ')')
            .addClass('objectfit-fallback');
        }
      });
    }

    // Modernizr: ios detection
    Modernizr.addTest('ios', function () {
      return navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false
    });
  }

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

  // Tracking event for Gravity Forms submission
  $(document).bind('gform_confirmation_loaded', function(event, formId){
    if (typeof ga === 'function') {
      ga('send', 'event', 'Forms', 'Submission', 'formid_'+formId);
    }
  });

  // Email obfuscation
  $("span.cryptemail").each(function(){
    var spt = $(this);
    var at = / at /;
    var dot = / dot /g;
    var addr = $(spt).attr("title").replace(at,"@").replace(dot,".");
    $(spt).after('<a class="cryptemail" href="mailto:'+addr+'" title="'+$(spt).attr("title")+'">'+addr+'</a>')
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
  if (typeof($.fn.datepicker) == 'function' && typeof($.fn.datepicker.defaults) !== 'undefined') {
    if (stormbringer_config.THEME_LANG != '' && typeof($.fn.datepicker.defaults.language) !== 'undefined' ){
      $.fn.datepicker.defaults.language = stormbringer_config.THEME_LANG;
    }
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    $.fn.datepicker.defaults.startDate = now;
    $.fn.datepicker.defaults.format = 'dd-mm-yyyy';
    $.fn.datepicker.defaults.autoclose = true;
    $.fn.datepicker.defaults.todayBtn = true;
    $.fn.datepicker.defaults.todayHighlight = true;
    //$('.datepicker-input').datepicker({});
  }


  // Carousel swipe defaults
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

  // Owlcarousel defaults
  if (typeof($.fn.owlCarousel) == 'function') {

    $('.owl-carousel').each( function() {
      var $owlcarousel = $(this);

      responsive = $owlcarousel.data('responsive');
      if(responsive != ''){
        responsive = responsive.replace(/'/g,'"');
        responsive_json = $.parseJSON(responsive);
      }
      else{
        responsive_json = null;
      }

      $owlcarousel.owlCarousel({
        margin: $owlcarousel.data('margin'),
        loop: $owlcarousel.data('loop'),
        center: $owlcarousel.data('center'),
        nav: $owlcarousel.data('controls'),
        dots: $owlcarousel.data('indicators'),
        animateOut: $owlcarousel.data('animateout'),
        animateIn: $owlcarousel.data('animatein'),
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
        responsive: responsive_json
      });
    });
  }

  // Analytics decorate iframes
  if ('ga' in window){
    ga(function(tracker) {
      var clientId = tracker.get('clientId');
      window.linker = window.linker || new window.gaplugins.Linker(tracker);
      $('iframe').each( function() {
        if($(this).attr('src') != ''){
          $(this).attr('src', window.linker.decorate($(this).attr('src')));
        }
      });
    });
  }


  // Woocommerce: handheld footer bar
  $( '.stormbringer-handheld-footer-bar .search > a' ).click( function(e) {
    $( this ).parent().toggleClass( 'active' );
    e.preventDefault();
  });



  var windowHeight	= jQuery( window ).height();
  var paymentHeight	= jQuery( '#order_review' ).height();

  // Woocommerce: Make the order review element stick to the top of the browser window.
  if (  $( '#order_review_heading' ).length &&  $( 'form.woocommerce-checkout' ).length &&  $( '#customer_details' ).length ) {
    console.log('sticky');
    function stickyPayment() {
      var tallestPaymentBox = -1;
      jQuery('.payment_box').each(function () {
        tallestPaymentBox = tallestPaymentBox > jQuery(this).outerHeight() ? tallestPaymentBox : jQuery(this).outerHeight();
      });

      var topDistance = $(document).scrollTop();
      var paymentWidth = $('#order_review_heading').outerWidth();
      var checkoutWidth = $('form.woocommerce-checkout').outerWidth();
      var addressWidth = $('#customer_details').outerWidth();
      var gutter = checkoutWidth - addressWidth - paymentWidth;
      var paymentOffset = addressWidth + gutter;
      var checkoutPosition = $('#order_review_heading').offset();
      var currentPaymentBox = $('.wc_payment_method input:checked').siblings('.payment_box').outerHeight();
      var termsHeight = 0; // If terms aren't being displayed don't include their height in calculations
      if ($('.wc-terms-and-conditions').length) {
        termsHeight = 216; // This is static and set by WooCommerce core + 16px margin added by Storefront
      }
      var expandedHeight = paymentHeight + termsHeight + ( tallestPaymentBox - currentPaymentBox + 30 );
      var customerDetailsHeight = $('#customer_details').outerHeight();

      // If we're in desktop orientation and the order review column is taller than the customer details column and smaller than the window height
      if (( $(window).width() > 768 ) && ( customerDetailsHeight > expandedHeight ) && ( windowHeight > expandedHeight )) {

        if (topDistance > checkoutPosition.top) {
          $('#order_review').addClass('payment-fixed');
          if ($('#order_review').css('direction') === 'rtl') {
            $('#order_review').css({
              'margin-right': paymentOffset,
              'width': paymentWidth
            });
          }
          else {
            $('#order_review').css({
              'margin-left': paymentOffset,
              'width': paymentWidth
            });
          }
        }
        else {
          $('#order_review').removeAttr('style').removeClass('payment-fixed');
        }
      }
    }
    // Do sticky on scroll
    $(window).scroll(function () {
      stickyPayment();
    });
    // Do sticky on window resize
    $(window).resize(function () {
      stickyPayment();
    });
  }

});