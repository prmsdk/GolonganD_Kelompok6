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

$("#select_warna").change(function () {
  $(this).find("input:checked").each(function () {
    var optionValue = $(this).attr("value");
    if (optionValue) {
      $(".box_warna").not("#" + optionValue).hide();
      $(".box_warna").not("#" + optionValue).attr('required', '');
      $("#" + optionValue).show();
      $("#" + optionValue).attr('required', 'required');
    } else {
      $(".box_warna").hide();
    }
  });
}).change();

// TOTAL HARGA PRODUK

$(document).on('click', 'body *', function () {

  var TotHarga = 0;
  var HrgWarna = 0;
  var HrgBahan = 0;
  var SatBahan = 0;
  var IsiBahan = 1;
  var HrgUkuran = 0;
  var ValDesain = 0;
  var HrgDesain = 50000;
  var ValPembayaran = 0;
  var JmlCetak = document.getElementById('jumlah_produk').value;

  $("#select_warna").change(function () {
    $(this).find("input:checked").each(function () {
      HrgWarna = parseInt($(this).attr("aria-describedby"));
    });
  }).change();

  $("#select_bahan").change(function () {
    $(this).find("input:checked").each(function () {
      HrgBahan = parseInt($(this).attr("aria-describedby"));
    });
  }).change();

  $("#select_bahan").change(function () {
    $(this).find("input:checked").each(function () {
      SatBahan = parseInt($(this).attr("placeholder"));
    });
  }).change();

  $("#select_ukuran").change(function () {
    $(this).find("input:checked").each(function () {
      HrgUkuran = parseInt($(this).attr("aria-describedby"));
    });
  }).change();

  $("#pilihan_desain").change(function () {
    $(this).find("input:checked").each(function () {
      ValDesain = parseInt($(this).attr("value"));
    });
  }).change();

  $("#pembayaran").change(function () {
    $(this).find("input:checked").each(function () {
      ValPembayaran = parseInt($(this).attr("value"));
    });
  }).change();


  TotHarga = ((HrgDesain * ValDesain) + (HrgWarna + HrgUkuran) + IsiBahan * (HrgBahan * (JmlCetak / SatBahan))) / ValPembayaran;

  $("#sub_total").prop('value', TotHarga);
  console.log(dataukuran);

  $("#keranjang").attr("data-ukuran", HrgUkuran);
  

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

// Upload gambar

$('.custom-file-input').on('change',function(){
  let fileName = $(this).val().split('\\').pop();
  $(this).next('.custom-file-label').addClass("custom-file").html(fileName);
});

// checkbox all

$('#ceksemua').click(function () {
  $(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
  });