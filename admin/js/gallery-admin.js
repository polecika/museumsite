var setOpacity = function(curr, last, el_curr, el_last, elements) {
  if (last !== null) {
    $($('li', '#thumbs')[last]).animate({opacity: .6});
  }
  $($('li', '#thumbs')[curr]).animate({opacity: 1});
}

var bindThumbnails = function() {
  $('a', '#thumbs').each(function() {
    $(this).unbind();
    $(this).click(function() {
      var i = $($(this).parents('li').get(0)).attr('id').substring(6);
      $('#photos').xfadeTo($('#photo-' + i));
      return false;
    });
  });
}

$(document).ready(function() {
  $('#photos').xfade({height: 430, onBefore: setOpacity});

  bindThumbnails();

  $('#append-item').click(function() {
    var id = $('#thumbs').children().length + 1;
    var thumb = '<li id="thumb-' + id + '"><a href="#t">' + $('.thumb', '#append').html() + '</a></li>';
    $(thumb).appendTo('#thumbs');

    var photos = '<li id="photo-' + id + '"><a href="#p">' + $('.photo', '#append').html() + '</a></li>';
    $(photos).appendTo('#photos');
    $('#photos').xfadeRefresh();

    bindThumbnails();
  });

  $('#remove-item').click(function() {
    $('#thumbs').children().last().remove();
    $('#photos').children().last().remove();
    $('#photos').xfadeRefresh();
  });
});