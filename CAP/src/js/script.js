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

  $("#select_bahan").change(function(){
    $(this).find("option:selected").each(function(){
        var optionValue = $(this).attr("value");
        if(optionValue){
            $(".box_bahan").not("#" + optionValue).hide();
            $("#" + optionValue).show();
        } else{
            $(".box_bahan").hide();
        }
    });
  }).change();

  $("#select_ukuran").change(function(){
    $(this).find("option:selected").each(function(){
        var optionValue = $(this).attr("value");
        if(optionValue){
            $(".box_ukuran").not("#" + optionValue).hide();
            $("#" + optionValue).show();
        } else{
            $(".box_ukuran").hide();
        }
    });
  }).change();
});

// MENAMPILAKN UPLOAD GAMBAR SAAT DI PILIH

$(document).ready(function() {
  // Kondisi saat Form di-load
  if($('input[id="pilihdesain1"]:radio:checked').val()=="Y"){
      $('#uploadfile').removeAttr('disabled');
  } else {
      $('#uploadfile').attr('disabled','disabled'); 
  }
  // Kondisi saat Radio Button diklik
  // $('input[type="radio"]').click(function(){
  $('input[id="pilihdesain1"]:radio').click(function(){
      if($(this).attr("value")=="N"){
          $('#uploadfile').attr('disabled','disabled'); 
      } else {
          $('#uploadfile').removeAttr('disabled');
          $('#uploadfile').focus();
      } 
  });
}); 

$(document).ready(function() {
  // Kondisi saat Form di-load
  if($('input[id="pilihdesain2"]:radio:checked').val()=="Y"){
      $('#uploadfile').attr('disabled','disabled'); 
  } else {
      $('#uploadfile').attr('disabled','disabled'); 
  }
  // Kondisi saat Radio Button diklik
  // $('input[type="radio"]').click(function(){
  $('input[id="pilihdesain2"]:radio').click(function(){
      if($(this).attr("value")=="N"){
          $('#uploadfile').attr('disabled','disabled'); 
      } else {
          $('#uploadfile').attr('disabled','disabled');
          $('#uploadfile').focus();
      } 
  });
}); 

function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
