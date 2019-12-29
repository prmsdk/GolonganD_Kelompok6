

$(document).ready(function(){

  function load_unseen_notification(view = '')
  {
    $.ajax({
    url:"fetch_notif_admin.php",
    method:"POST",
    data:{view:view},
    dataType:"json",
    success:function(data)
    {
      $('.wadah-notif-dropdown').html(data.notification);
      if(data.unseen_notification > 0){
        $('.notif-count').html(data.unseen_notification);
      }
    }
    });
  }
  
  load_unseen_notification();
  
  setInterval(function(){ 
    load_unseen_notification();; 
  }, 5000);
  
});

/* ANIMASI ANGKA */

$('.Count').each(function () {
  var $this = $(this);
  jQuery({ Counter: 0 }).animate({ 
    Counter: $this.text() }, 
    {
    duration: 2000,
    easing: 'swing',
    step: function () {
      $this.text(Math.ceil(this.Counter).toLocaleString('id'));
    }
  });
});

$("#yearpicker").datepicker({
  format: " yyyy",
  startView: "years", 
  minViewMode: "years"
});

$("#monthpicker").datepicker({
  format: " yyyy-mm",
  startView: "months", 
  minViewMode: "months"
});

$("#daypicker1").datepicker({
  format: " yyyy-mm-dd",
  startView: "days", 
  minViewMode: "days"
});

$("#daypicker2").datepicker({
  format: " yyyy-mm-dd",
  startView: "days", 
  minViewMode: "days"
});

$('#formrentang').on("submit",function(){

  var tgl_awal_str = document.getElementById("daypicker1").value;
  var tgl_akhir_str = document.getElementById("daypicker2").value;
  var tgl_awal = new Date(tgl_awal_str.substring(11,1));
  var tgl_akhir = new Date(tgl_akhir_str.substring(11,1));
  var tanggal = tgl_akhir - tgl_awal;
  
  console.log(tanggal);
  if(tanggal <= 0){
    alert("Tanggal Akhir tidak boleh lebih awal daripada Tanggal Awal");
    return false;
  }else if(tanggal< (5*86400000) && tanggal > 0){
    alert("Untuk menampilkan grafik, jumlah rentang hari yang dipilih harus lebih dari 5 hari");
    return false;
  }else if(tanggal>(30 * 86400000)){
    alert("Untuk menampilkan grafik, jumlah rentang hari yang dipilih harus kurang dari 30 hari");
    return false;
  }else{
    return true;
  }
});

$("#select_isi").change(function () {
  $(this).find("input:checked").each(function () {
    var optionValue = $(this).attr("value");
    if (optionValue) {
      $(".box_isi").not("#" + optionValue).hide();
      $(".box_isi").not("#" + optionValue).attr('required', '');
      $("#" + optionValue).show();
      $("#" + optionValue).attr('required', 'required');
    } else {
      $(".box_isi").hide();
    }
  });
}); 

if ($("#isi_produk2").prop("checked")) {
  $("#1").show();
  $("#1").attr('required', 'required');
}
