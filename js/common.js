// add in-frame class
if(self !== top){
  document.documentElement.className ='in-iframe';
}
$(document).ready(function() {

  // Modals remote
  $('a[data-toggle="modal"]').click(function (e) {
    title='Info';
    if($(this).attr('title')!='')
      title= $(this).attr('title');
    if($(this).data('modal-title')!='')
      title= $(this).data('modal-title');
    
    $($(this).data('target')+' .modal-title').text(title);
    if($(this).attr('href')!='')
      $($(this).data('target')+' .modal-body').html('<iframe src="'+$(this).attr('href')+'" width="100%" height="350" frameborder="0" allowfullscreen="0"></iframe>');
  });
  
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

  // Contact Form default place holds WPCF7
  $('.wpcf7-text, .wpcf7-textarea').each(function(){
    $(this).attr('placeholder',$(this).val());
    if($(this).text()!="")$(this).attr('placeholder',$(this).text());
    $(this).val("");
  });

  // GravityForms auto placeholder
	/*$.each($('.gform_wrapper input, .gform_wrapper textarea, .gform_wrapper select'), function () {
		var gfapId = this.id;
		var gfapLabel = $('label[for=' + gfapId + ']');
		$(gfapLabel).hide();
		//var gfapLabelValue = $(gfapLabel).text().replace("*","");
		var gfapLabelValue = $(gfapLabel).text().replace("*"," *");
		$(this).attr('placeholder',gfapLabelValue);
	});
  */
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
  $('a[rel$="external"]').on('click', function() {
    $(this).attr('target', "_blank");
  });
  $("a[href^='http:']:not([href*='" + window.location.host + "'])").on('click', function() {
    $(this).attr("target", "_blank");
  });

  // adds last and first classes to UL lists
  $("ul li:first-child").addClass("first");
  $("ul li:last-child").addClass("last");


  // GRavity Forms disabled fields
  $('input[data-disabled="1"],textarea[data-disabled="1"]').each(function (e) {
    if($(this).val()!='')
      $(this).attr('readonly','readonly');
  });

});

/*
// crypt emails
$(function(){
  var spt = $('span.cryptemail');
  var at = / at /;
  var dot = / dot /g;
  var addr = $(spt).attr("title").replace(at,"@").replace(dot,".");
  $(spt).after('<a class="cryptemail" href="mailto:'+addr+'" alt="'+$(spt).attr("title")+'">'+addr+'</a>')
  .hover(function(){window.status="Contact";}, function(){window.status="";});
  $(spt).remove();
});
*/
