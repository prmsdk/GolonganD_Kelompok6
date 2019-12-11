

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
    duration: 1000,
    easing: 'swing',
    step: function () {
      $this.text(Math.ceil(this.Counter).toLocaleString('id'));
    }
  });
});
