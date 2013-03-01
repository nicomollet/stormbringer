$(document).ready(function() {

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
      modal.modal(options);
    }

  });


  // Modal frame
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
    }
    $(target).modal();

    return false;
  });


});

