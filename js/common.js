$(document).ready(function() {

  // Modal, remove frame content on hiding
  $('.modal').bind('hide', function () {
    var iframe = $(this).children('div.modal-body').find('iframe');
    iframe.attr('src', '');
  });

  // Modal simgle image open by class
  $( ".modal-open-image" ).click(function (e) {

    var rand = $.Random(0,100);
    $(this).attr('id','randomlink-'+rand);
    $(this).data('selector','#randomlink-'+rand);
    $(this).data('toggle','modal-gallery');
    $(this).data('target','#modal-gallery');

    var $this = $(this),
      options = $this.data(),
      modal = $(options.target),
      data = modal.data('modal'),
      link;

    link = $(e.target).closest(options.selector);

    if (link.length && modal.length) {
      e.preventDefault();
      options.href = link.prop('href') || link.data('href');
      options.delegate = link[0] !== this ? this : document;
      if (data) {
        $.extend(data.options, options);
      }
      modal.modal(options);
    }

  });


  // Modal gallery open by class
  $( ".modal-open-gallery" ).click(function (e) {

    $(this).data('selector','.modal-open-gallery');
    $(this).data('toggle','modal-gallery');
    $(this).data('target','#modal-gallery');

    var $this = $(this),
      options = $this.data(),
      modal = $(options.target),
      data = modal.data('modal'),
      link;

    link = $(e.target).closest(options.selector);

    if (link.length && modal.length) {
      e.preventDefault();
      options.href = link.prop('href') || link.data('href');
      options.delegate = link[0] !== this ? this : document;
      if (data) {
        $.extend(data.options, options);
      }
      modal.modal(options);
    }

  });


  // Modal frame
  //$('a[data-toggle="modal"]').click(function (e) {
  $('a.modal-open-frame').click(function (e) {
    height = $(this).data('height');
    target = $(this).data('target');
    target = '#modal-default';
    title='';
    if($(this).attr('title')!='')
      title= $(this).attr('title');
    else
      if($(this).data('modal-title')!='')
        title= $(this).data('modal-title');

    $(target+' .modal-title').text(title);
    if($(this).attr('href')!=''){
      $('#modal-frame').attr('src','');
      $('#modal-frame').html('');
      //$($(this).data('target')+' .modal-body').html('<iframe src="'+$(this).attr('href')+'" width="100%" height="350" frameborder="0" allowfullscreen="0"></iframe>');
      //$(target+' .modal-body').html('');
      //$modalframe =$('<iframe width="100%" height="'+height+'" id="modal-frame" name="modal-frame' + new Date().getTime() + '" frameborder="0" hspace="0" ' + (navigator.userAgent.match(/msie/i) ? 'allowtransparency="true""' : '') +  '" src="' + $(this).attr('href') + '"></iframe>');
      //$modalframe.appendTo(target+' .modal-body');
      $('#modal-frame').attr('src',$(this).attr('href'));
      $('#modal-frame').load(resizeModal);
      function resizeModal(){
        if(!height)
          height = Math.max($('#modal-frame').contents().find("html").height(),350);
        $(target+' .modal-body').height( height + 15);
      }
      //$('<iframe id="fancybox-frame" name="fancybox-frame' + new Date().getTime() + '" frameborder="0" hspace="0" ' + (navigator.userAgent.match(/msie/i) ? 'allowtransparency="true""' : '') +  ' src="/form"></iframe>').appendTo($(this).data('target')+' .modal-body');
    }
    $(target).modal();

    return false;
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

  // Adds last and first classes to UL lists
  $("ul li:first-child").addClass("first");
  $("ul li:last-child").addClass("last");


  // GRavity Forms disabled fields
  $('input[data-disabled="1"],textarea[data-disabled="1"]').each(function (e) {
    if($(this).val()!='')
      $(this).attr('readonly','readonly');
  });


  /* Email obfuscation */
  $("span.cryptemail").each(function(){
    var spt = $(this);
    var at = / at /;
    var dot = / dot /g;
    var addr = $(spt).attr("title").replace(at,"@").replace(dot,".");
    $(spt).after('<a class="cryptemail" href="mailto:'+addr+'" alt="'+$(spt).attr("title")+'">'+addr+'</a>')
      .hover(function(){window.status="Contact";}, function(){window.status="";});
    $(spt).remove();
  });

});

/* Randon function */
jQuery.Random = function(m,n)
{
  m = parseInt(m);
  n = parseInt(n);
  return Math.floor( Math.random() * (n - m + 1) ) + m;
}

/* Addthis configuration */
var addthis_config = {"data_track_clickback":false,"data_track_addressbar":false,"ui_language":"fr","ui_508_compliant":true};if (typeof(addthis_share) == "undefined"){ addthis_share = {"templates":{"twitter":"{{title}} {{url}}"}};}

