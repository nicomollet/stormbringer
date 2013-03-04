$(document).ready(function() {

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

