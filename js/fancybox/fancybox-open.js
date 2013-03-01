// Fancybox
if(jQuery().fancybox)
{
  // Fancybox : default config
  $.extend($.fn.fancybox.defaults, {
    padding : 20,
    margin :20,
    width : '50%',
    height : '50%',
    overlayColor	:	'#333333',
    titlePosition	:	'inside',
    cyclic		:	true,
    autoScale		:	false,
    centerOnScroll		:	true,
    overlayOpacity : 0.75,
    autoDimensions: false
  });
}

$(document).ready(function() {

  // Detect if page is open in a (i)frame, assuming in a fancybox
  if(self !== top){
    // calculate new height with fancybox with frame content
    var max_h = $('body').outerHeight(true);
    var viewport_h = parent.document.documentElement.clientHeight - 30;
    var new_h = ((max_h < viewport_h) ? max_h : viewport_h);
    parent.$('#fancybox-content').css('height', function() { return parseInt(new_h) });
    // resize and center fancybox
    parent.$.fancybox.center();
    parent.$.fancybox.resize();
  }

  // Fancybox
  if(jQuery().fancybox)
  {
    // standard fancybox
    $('a.fancybox').fancybox();

    // gallery fancybox
    $('ul.gallery').each(function(){$('a.fancybox',$(this)).attr("rel",$(this).attr('id'));});

    // iframe fancybox
    $('a.fancybox-frame').fancybox({
      'padding'           :   0,
      'type'           :   'iframe',
      'titleShow'      : false,
      'autoScale'		   :	true,
      'autoDimensions' : true,
      'onComplete' : function(){
        $('#fancybox-frame').load(function () {
          $(this).contents().find('.ginput_object input').val($('h1.entry-title').text()).parent().parent().hide();
        });

      }
    });

    // ajaxload fancybox
    $('a.fancybox-ajaxload').on('click', function() {
      href = $(this).attr('href');
      box_from = '#content';
      fancybox_ajaxload(href, box_from,"fancybox-ajaxinner");
      return false;
    } );
  } else {
    // jquery fancybox hasn't been loaded
  }

  // ajalox load function
  function fancybox_ajaxload(href,box_from,box_to){
    $("#"+box_to).html('');
    $("#"+box_to).html('<img src="'+template_url+'/img/ajax-loader.gif" alt="Chargement" id="fancybox-loadingicon" />');
    $("#"+box_to).load(href + " #" + box_from, function(response, status, xhr) {

      if (status == "error") {
        var msg = "Erreur de chargement : ";
        $("#"+box_to).html(msg + xhr.status + " " + xhr.statusText);
      }
      if (status == "success") {
        $.fancybox({
          'href' : '#'+box_to
        });
      }
    });
  }
});

