$(document).ready(function() {

  $('div.gform_footer').addClass("form-actions");

  // Fancybox
  if(jQuery().fancybox)
  {
    //$("a.fancybox img").tooltip({'placement':"bottom"});
    $("a.fancybox").attr("rel","gallery").fancybox({
      'overlayOpacity'	:	0.8,
      'overlayColor'	:	'#333333',
      'titlePosition'	:	'inside',
      'cyclic'		:	true,
      'autoScale'		:	true,
      'centerOnScroll'		:	true
    });
  } else {
       // jquery fancybox hasn't been loaded
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


    // Open external links in a new window or tab
    $('a[rel$="external"]').live('click', function() {
      $(this).attr('target', "_blank");
    });
    $("a[href^='http:']:not([href*='" + window.location.host + "'])").live('click', function() {
      $(this).attr("target", "_blank");
    });
  }
});