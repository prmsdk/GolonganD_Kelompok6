/* SCRIPT UNTUK MENGHILANGKAN ALERT SECARA OTOMATIS SELAMA 2 DETIK */

$("#alert-login").fadeTo(2000, 500).slideUp(500, function(){
  $("#alert-login").slideUp(500);
  history.pushState(null, null, window.location.href.split('#')[0]);
  window.location.hash = '';
});

/* SCRIPT UNUTUK MENAMPILKAN KATA SANDI KETIKA DICENTANG */

$(document).ready(function(){		
  $('#tampil-sandi').click(function(){
    if($(this).is(':checked')){
      $('.tampil-sandi').attr('type','text');
    }else{
      $('.tampil-sandi').attr('type','password');
    }
  });
});

