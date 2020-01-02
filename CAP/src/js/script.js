/* SCRIPT UNTUK MENGHILANGKAN ALERT SECARA OTOMATIS SELAMA 2 DETIK */

$("#alert-login").fadeTo(2000, 500).slideUp(500, function () {
  $("#alert-login").slideUp(500);
});

$(document).ready(function () {
  $('#example').DataTable();
});

/* SCRIPT UNUTUK MENAMPILKAN KATA SANDI KETIKA DICENTANG */

$(document).ready(function () {
  $('#tampil-sandi').click(function () {
    if ($(this).is(':checked')) {
      $('.tampil-sandi').attr('type', 'text');
    } else {
      $('.tampil-sandi').attr('type', 'password');
    }
  });

  $("#select_bahan").change(function () {
    $(this).find("option:selected").each(function () {
      var optionValue = $(this).attr("value");
      if (optionValue) {
        $(".box_bahan").not("#" + optionValue).hide();
        $("#" + optionValue).show();
      } else {
        $(".box_bahan").hide();
      }
    });
  }).change();

  $("#select_ukuran").change(function () {
    $(this).find("option:selected").each(function () {
      var optionValue = $(this).attr("value");
      if (optionValue) {
        $(".box_ukuran").not("#" + optionValue).hide();
        $("#" + optionValue).show();
      } else {
        $(".box_ukuran").hide();
      }
    });
  }).change();
});

// MENAMPILAKN UPLOAD GAMBAR SAAT DI PILIH

$(document).ready(function () {
  // Kondisi saat Form di-load
  if ($('input[id="pilihdesain1"]:radio:checked').val() == "Y") {
    $('#uploadfile').removeAttr('disabled');
    $('#uploadSubmit').removeAttr('disabled');
  } else {
    $('#uploadfile').attr('disabled', 'disabled');
    $('#uploadSubmit').attr('disabled', 'disabled');
  }
  // Kondisi saat Radio Button diklik
  // $('input[type="radio"]').click(function(){
  $('input[id="pilihdesain1"]:radio').click(function () {
    if ($(this).attr("value") == "N") {
      $('#uploadfile').attr('disabled', 'disabled');
      $('#uploadSubmit').attr('disabled', 'disabled');
    } else {
      $('#uploadfile').removeAttr('disabled');
      $('#uploadSubmit').removeAttr('disabled');
      $('#uploadfile').focus();
    }
  });
});

$(document).ready(function () {
  // Kondisi saat Form di-load
  if ($('input[id="pilihdesain2"]:radio:checked').val() == "Y") {
    $('#uploadfile').attr('disabled', 'disabled');
    $('#uploadSubmit').attr('disabled', 'disabled');
    $("#targetLayer").append('<input type="hidden" id="namadesain" name="namadesain" value="">');
  } else {
    $('#uploadfile').attr('disabled', 'disabled');
    $('#uploadSubmit').attr('disabled', 'disabled');
  }
  // Kondisi saat Radio Button diklik
  // $('input[type="radio"]').click(function(){
  $('input[id="pilihdesain2"]:radio').click(function () {
    if ($(this).attr("value") == "N") {
      $('#uploadfile').attr('disabled', 'disabled');
      $('#uploadSubmit').attr('disabled', 'disabled');
    } else {
      $("#targetLayer").append('<input type="hidden" id="namadesain" name="namadesain" value="">');
      $('#uploadfile').attr('disabled', 'disabled');
      $('#uploadSubmit').attr('disabled', 'disabled');
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
}); 

$(document).ready(function(){
  var button = document.getElementById('clear-cart');
  button.click();

  var buttonpemb = document.getElementById('verif_pembayaran');
  buttonpemb.click();

});

// TOTAL HARGA PRODUK

$(document).on('click', 'body *', function () {

  var TotHarga = 0;

  var ModalHarga = 0;

  var HrgWarna = 0;
  var HrgBahan = 0;
  var SatBahan = 0;
  // var IsiBahan = 1;
  var HrgUkuran = 0;
  var ValDesain = 0;
  var HrgDesain = 50000;
  var ValPembayaran = 0;


  var JmlCetak = Number(document.getElementById('jumlah_produk').value);

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

  var IsiBahan = Number(document.getElementById('isibahan').value);

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

  // ModalHarga = ((HrgDesain * ValDesain) + (HrgWarna + HrgUkuran) + IsiBahan * (HrgBahan * (1 / 500))) / ValPembayaran;
  // $("#modal_total").prop('value', ModalHarga);

  var Var1 = (HrgDesain * ValDesain) + (HrgWarna + HrgUkuran);
  var Var2 = IsiBahan * HrgBahan;
  $("#var1").prop('value', Var1);
  $("#var2").prop('value', Var2);
  $("#var3").prop('value', SatBahan);
  $("#var4").prop('value', ValPembayaran);


  function rubah(angka){
    var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan;
  }

  $("#sub_total").prop('value', 'Rp. ' + rubah(TotHarga));
  $("#sub_total_form").prop('value', TotHarga);
  // var jumlah = parseInt(document.getElementById("jumlah").value);

  // if(jumlah < 1){
  //   alert("Jumlah pesanan paling sedikit 1 pcs");
  //   $("#jumlah").prop('value','1');
  // }

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

$(document).ready(function(){
	$('#uploadImage').submit(function(event){
		if($('#uploadfile').val())
		{
      event.preventDefault();
      $('.progress').show();
			$('#loader-icon').show();
      $('#targetLayer').hide();
      $('#targetUpload').hide();
			$(this).ajaxSubmit({
				target: '#targetLayer, #targetUpload',
				beforeSubmit:function(){
					$('.progress-bar').width('50%');
				},
				uploadProgress: function(event, position, total, percentageComplete)
				{
					$('.progress-bar').animate({
						width: percentageComplete + '%'
					}, {
						duration: 1000
					});
				},
				success:function(){
					$('#loader-icon').hide();
          $('#targetLayer').show();
          // $('#targetUpload').show();
          // $('#pilihdesain2').prop('disabled','true');
        },
				resetForm: true
			});
		}
		return false;
	});
});
