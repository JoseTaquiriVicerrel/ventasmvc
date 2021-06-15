$(document).ready(function () {
  $.ajaxSetup({ cache: false });

  $('a[is-modal]').on('click', function (e) {
    $('#modalGenerico').modal({  keyboard: true }, 'show');
    $('#content-modal').load(this.href, function () {
      console.log(this.href);
      return false;
    });
    // alert('holaf')

    // console.log(e);
  });
  $('#modalGenerico').on('hidden.bs.modal', function () {
    $('#content-modal').html('');
  });

})