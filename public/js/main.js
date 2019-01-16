$(document).ready(function () {
  $('#visi').summernote({
    placeholder : 'Isi berita',
    height : 200
  });
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

  $('input[name="date"]').flatpickr({
    format : 'Y-m-d',
    mode : 'range'
  });

  $('.hapus-berita').click(function(ev){
    ev.preventDefault();
    $(this).siblings('form').submit();
  });

  $('#tambah-fasilitas').click(function(ev){
    ev.preventDefault();
    $('#facility').html($('input[name="facility[]"]').addClass('mb-1 mt-1').clone());
    return false;
  });

  $('.slide').click(function(){
    $('#banner').slideUp();
  });
});