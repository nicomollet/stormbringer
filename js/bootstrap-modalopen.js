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
      $('#modal-frame').attr('src','');
      $('#modal-frame').html('');
      $('#modal-frame').attr('src',$(this).attr('href'));
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
  var getIFrameHeight = function() {
    tmp=0;
    if(!iframe_height){
      iframe_height = 150;
      if(!iframe_external){
        $(this).contents().find(".movetomodal-footer").remove();
        tmp = $(this).contents().find("html").height();
        console.log('height iframe external: '+tmp);
        iframe_height = Math.max(tmp,iframe_height);
      }
    }
    //console.log('height final: '+iframe_height);
    $('#modal-default'+' .modal-body').animate({height:iframe_height + 15+"px"}); // animated
  };
  $('#modal-frame').bind('load', moveModalFooter );
  $('#modal-frame').bind('load', getIFrameHeight );

});

