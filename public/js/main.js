$(document).ready(function () {
  $('.load-more').click(function () {
    if (!$(this).hasClass('d-none')) {
      $(this).addClass('d-none');
      $('#news' + $(this).data('id')).removeClass('text-truncate');
      $('#load-less' + $(this).data('id')).removeClass('d-none');
    }
  });

  $('.load-less').click(function () {
    $('#load-more' + $(this).data('id')).removeClass('d-none');
    $('#news' + $(this).data('id')).addClass('text-truncate');
    $(this).addClass('d-none');
  });

  $('.hapus-berita').click(function(ev){
    ev.preventDefault();
    $(this).siblings('form').submit();
  })
});