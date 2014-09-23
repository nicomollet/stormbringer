$(document).ready(function() {

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


(function(a){"use strict";var b=function(a,c,d){var e=document.createElement("img"),f,g;return e.onerror=c,e.onload=function(){g&&(!d||!d.noRevoke)&&b.revokeObjectURL(g),c(b.scale(e,d))},window.Blob&&a instanceof Blob||window.File&&a instanceof File?(f=g=b.createObjectURL(a),e._type=a.type):f=a,f?(e.src=f,e):b.readFile(a,function(a){var b=a.target;b&&b.result?e.src=b.result:c(a)})},c=window.createObjectURL&&window||window.URL&&URL.revokeObjectURL&&URL||window.webkitURL&&webkitURL;b.detectSubsampling=function(a){var b=a.width,c=a.height,d,e;return b*c>1048576?(d=document.createElement("canvas"),d.width=d.height=1,e=d.getContext("2d"),e.drawImage(a,-b+1,0),e.getImageData(0,0,1,1).data[3]===0):!1},b.detectVerticalSquash=function(a,b){var c=document.createElement("canvas"),d=c.getContext("2d"),e,f,g,h,i;c.width=1,c.height=b,d.drawImage(a,0,0),e=d.getImageData(0,0,1,b).data,f=0,g=b,h=b;while(h>f)i=e[(h-1)*4+3],i===0?g=h:f=h,h=g+f>>1;return h/b},b.renderImageToCanvas=function(a,c,d,e){var f=a.width,g=a.height,h=c.getContext("2d"),i,j=1024,k=document.createElement("canvas"),l,m,n,o,p;h.save(),b.detectSubsampling(a)&&(f/=2,g/=2),i=b.detectVerticalSquash(a,g),k.width=k.height=j,l=k.getContext("2d"),m=0;while(m<g){n=m+j>g?g-m:j,o=0;while(o<f)p=o+j>f?f-o:j,l.clearRect(0,0,j,j),l.drawImage(a,-o,-m),h.drawImage(k,0,0,p,n,Math.floor(o*d/f),Math.floor(m*e/g/i),Math.ceil(p*d/f),Math.ceil(n*e/g/i)),o+=j;m+=j}h.restore(),k=l=null},b.scale=function(a,c){c=c||{};var d=document.createElement("canvas"),e=a.width,f=a.height,g=Math.max((c.minWidth||e)/e,(c.minHeight||f)/f);return g>1&&(e=parseInt(e*g,10),f=parseInt(f*g,10)),g=Math.min((c.maxWidth||e)/e,(c.maxHeight||f)/f),g<1&&(e=parseInt(e*g,10),f=parseInt(f*g,10)),a.getContext||c.canvas&&d.getContext?(d.width=e,d.height=f,a._type==="image/jpeg"?b.renderImageToCanvas(a,d,e,f):d.getContext("2d").drawImage(a,0,0,e,f),d):(a.width=e,a.height=f,a)},b.createObjectURL=function(a){return c?c.createObjectURL(a):!1},b.revokeObjectURL=function(a){return c?c.revokeObjectURL(a):!1},b.readFile=function(a,b){if(window.FileReader&&FileReader.prototype.readAsDataURL){var c=new FileReader;return c.onload=c.onerror=b,c.readAsDataURL(a),c}return!1},typeof define=="function"&&define.amd?define(function(){return b}):a.loadImage=b})(this);
(function(a){"use strict",typeof define=="function"&&define.amd?define(["jquery","load-image","bootstrap"],a):a(window.jQuery,window.loadImage)})(function(a,b){"use strict",a.extend(a.fn.modal.defaults,{delegate:document,selector:null,filter:"*",index:0,href:null,preloadRange:2,offsetWidth:100,offsetHeight:200,canvas:!1,slideshow:0,imageClickDivision:.5});var c=a.fn.modal.Constructor.prototype.show,d=a.fn.modal.Constructor.prototype.hide;a.extend(a.fn.modal.Constructor.prototype,{initLinks:function(){var b=this,c=this.options,d=c.selector||"a[data-target="+c.target+"]";this.$links=a(c.delegate).find(d).filter(c.filter).each(function(a){b.getUrl(this)===c.href&&(c.index=a)}),this.$links[c.index]||(c.index=0)},getUrl:function(b){return b.href||a(b).data("href")},getDownloadUrl:function(b){return a(b).data("download")},startSlideShow:function(){var a=this;this.options.slideshow&&(this._slideShow=window.setTimeout(function(){a.next()},this.options.slideshow))},stopSlideShow:function(){window.clearTimeout(this._slideShow)},toggleSlideShow:function(){var a=this.$element.find(".modal-slideshow");this.options.slideshow?(this.options.slideshow=0,this.stopSlideShow()):(this.options.slideshow=a.data("slideshow")||5e3,this.startSlideShow()),a.find("i").toggleClass("icon-play icon-pause")},preloadImages:function(){var b=this.options,c=b.index+b.preloadRange+1,d,e;for(e=b.index-b.preloadRange;e<c;e+=1)d=this.$links[e],d&&e!==b.index&&a("<img>").prop("src",this.getUrl(d))},loadImage:function(){var a=this,c=this.$element,d=this.options.index,e=this.getUrl(this.$links[d]),f=this.getDownloadUrl(this.$links[d]),g;this.abortLoad(),this.stopSlideShow(),c.trigger("beforeLoad"),this._loadingTimeout=window.setTimeout(function(){c.addClass("modal-loading")},100),g=c.find(".modal-image").children().removeClass("in"),window.setTimeout(function(){g.remove()},3e3),c.find(".modal-title").text(this.$links[d].title),c.find(".modal-download").prop("href",f||e),this._loadingImage=b(e,function(b){a.img=b,window.clearTimeout(a._loadingTimeout),c.removeClass("modal-loading"),c.trigger("load"),a.showImage(b),a.startSlideShow()},this._loadImageOptions),this.preloadImages()},showImage:function(b){var c=this.$element,d=a.support.transition&&c.hasClass("fade"),e=d?c.animate:c.css,f=c.find(".modal-image"),g,h;f.css({width:b.width,height:b.height}),c.find(".modal-title").css({width:Math.max(b.width,380)}),d&&(g=c.clone().hide().appendTo(document.body)),a(window).width()>767?e.call(c.stop(),{"margin-top":-((g||c).outerHeight()/2),"margin-left":-((g||c).outerWidth()/2)}):c.css({top:(a(window).height()-(g||c).outerHeight())/2}),g&&g.remove(),f.append(b),h=b.offsetWidth,c.trigger("display"),d?c.is(":visible")?a(b).on(a.support.transition.end,function(d){d.target===b&&(a(b).off(a.support.transition.end),c.trigger("displayed"))}).addClass("in"):(a(b).addClass("in"),c.one("shown",function(){c.trigger("displayed")})):(a(b).addClass("in"),c.trigger("displayed"))},abortLoad:function(){this._loadingImage&&(this._loadingImage.onload=this._loadingImage.onerror=null),window.clearTimeout(this._loadingTimeout)},prev:function(){var a=this.options;a.index-=1,a.index<0&&(a.index=this.$links.length-1),this.loadImage()},next:function(){var a=this.options;a.index+=1,a.index>this.$links.length-1&&(a.index=0),this.loadImage()},keyHandler:function(a){switch(a.which){case 37:case 38:a.preventDefault(),this.prev();break;case 39:case 40:a.preventDefault(),this.next()}},wheelHandler:function(a){a.preventDefault(),a=a.originalEvent,this._wheelCounter=this._wheelCounter||0,this._wheelCounter+=a.wheelDelta||a.detail||0;if(a.wheelDelta&&this._wheelCounter>=120||!a.wheelDelta&&this._wheelCounter<0)this.prev(),this._wheelCounter=0;else if(a.wheelDelta&&this._wheelCounter<=-120||!a.wheelDelta&&this._wheelCounter>0)this.next(),this._wheelCounter=0},initGalleryEvents:function(){var b=this,c=this.$element;c.find(".modal-image").on("click.modal-gallery",function(c){var d=a(this);b.$links.length===1?b.hide():(c.pageX-d.offset().left)/d.width()<b.options.imageClickDivision?b.prev(c):b.next(c)}),c.find(".modal-prev").on("click.modal-gallery",function(a){b.prev(a)}),c.find(".modal-next").on("click.modal-gallery",function(a){b.next(a)}),c.find(".modal-slideshow").on("click.modal-gallery",function(a){b.toggleSlideShow(a)}),a(document).on("keydown.modal-gallery",function(a){b.keyHandler(a)}).on("mousewheel.modal-gallery, DOMMouseScroll.modal-gallery",function(a){b.wheelHandler(a)})},destroyGalleryEvents:function(){var b=this.$element;this.abortLoad(),this.stopSlideShow(),b.find(".modal-image, .modal-prev, .modal-next, .modal-slideshow").off("click.modal-gallery"),a(document).off("keydown.modal-gallery").off("mousewheel.modal-gallery, DOMMouseScroll.modal-gallery")},show:function(){if(!this.isShown&&this.$element.hasClass("modal-gallery")){var b=this.$element,d=this.options,e=a(window).width(),f=a(window).height();b.hasClass("modal-fullscreen")?(this._loadImageOptions={maxWidth:e,maxHeight:f,canvas:d.canvas},b.hasClass("modal-fullscreen-stretch")&&(this._loadImageOptions.minWidth=e,this._loadImageOptions.minHeight=f)):this._loadImageOptions={maxWidth:e-d.offsetWidth,maxHeight:f-d.offsetHeight,canvas:d.canvas},e>767?b.css({"margin-top":-(b.outerHeight()/2),"margin-left":-(b.outerWidth()/2)}):b.css({top:(a(window).height()-b.outerHeight())/2}),this.initGalleryEvents(),this.initLinks(),this.$links.length&&(b.find(".modal-slideshow, .modal-prev, .modal-next").toggle(this.$links.length!==1),b.toggleClass("modal-single",this.$links.length===1),this.loadImage())}c.apply(this,arguments)},hide:function(){this.isShown&&this.$element.hasClass("modal-gallery")&&(this.options.delegate=document,this.options.href=null,this.destroyGalleryEvents()),d.apply(this,arguments)}}),a(function(){a(document.body).on("click.modal-gallery.data-api",'[data-toggle="modal-gallery"]',function(b){var c=a(this),d=c.data(),e=a(d.target),f=e.data("modal"),g;f||(d=a.extend(e.data(),d)),d.selector||(d.selector="a[data-gallery=gallery]"),g=a(b.target).closest(d.selector),g.length&&e.length&&(b.preventDefault(),d.href=g.prop("href")||g.data("href"),d.delegate=g[0]!==this?this:document,f&&a.extend(f.options,d),e.modal(d))})})});
$(document).ready(function() {

  var iframe_height;
  var iframe_external;

  // Auto gallery tbmodal
  $('ul.gallery').each(function(){
    $('a.modal-open-image').addClass('modal-open-gallery').removeClass('modal-open-image');
    $('a.modal-open-gallery',$(this)).attr("rel",$(this).attr('id'));
  });

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

    title='';
    if($(this).attr('title')!='')
      title= $(this).attr('title');
    else
    {
      if($(this).data('modal-title')!='')
        title= $(this).data('modal-title');
    }


    $('#modal-gallery '+' .modal-footer').hide(); // hide footer when single image
    $('#modal-gallery '+' .modal-title').text(title);

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
      $('#modal-gallery '+' .modal-footer').show(); // show footer when single image
      modal.modal(options);
    }

  });


  // Modal frame
  $('a.modal-open-frame').click(function (e) {
    $modalframe = $('#modal-frame');
    $modalframe.hide();
    $modalframe.attr('src','');
    $modalframe.html('');
    iframe_height=0;
    iframe_external=false;
    iframe_external = $(this).attr('rel')=='external';
    iframe_height = $(this).data('height');
    //console.log('height userdefined 1: '+iframe_height);
    //console.log('external: '+iframe_external);
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
      e.preventDefault();
      if(iframe_height){
        $(target+' .modal-body').height( iframe_height + 15);
      }


      $modalframe.attr('src',$(this).attr('href'));
      $modalframe.show();
    }
    $(target).modal();
  });


  var moveModalFooter = function() {
    $('#modal-default .modal-footer').remove();
    $formfooter_id = $(this).contents().find(".movetomodal-footer");
    $formfooter_id.find('a').each(function(){$(this).attr('target','modal-frame');});
    if($formfooter_id && $formfooter_id.html()!=undefined){
      $formfooter = $formfooter_id.html();
      $formfooter_id.remove();
      $('#modal-default').append('<div class="modal-footer">'+$formfooter+'</div>');
    }
  }
  var updateModalTitle = function() {
    $title_id = $(this).contents().find(".page-header h1");
    if($title_id && $title_id.text()!=undefined && $title_id.text()!=''){
      $('#modal-default .modal-title').text($title_id.text());
    }
  }
  var getIframeHeight = function() {
    tmp=0;
    if(!iframe_height){
      iframe_height = 300;
      if(!iframe_external){
        $(this).contents().find(".movetomodal-footer").remove();
        tmp = $(this).contents().find("html").height();
        //console.log('height iframe external: '+tmp);
        iframe_height = Math.max(tmp,iframe_height);
      }
    }
    //console.log('height final: '+iframe_height);
    $('#modal-default'+' .modal-body').animate({height:iframe_height + 15+"px"}); // animated
  };
  $('#modal-frame').bind('load', moveModalFooter );
  $('#modal-frame').bind('load', getIframeHeight );
  $('#modal-frame').bind('load', updateModalTitle );

});


$(document).ready(function() {


});
