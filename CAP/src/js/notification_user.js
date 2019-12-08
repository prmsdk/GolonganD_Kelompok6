$(document).ready(function(){
  
  function load_unseen_notification(viewuser = '')
  {
    $.ajax({
    url:"fetch_notif_user.php",
    method:"POST",
    data:{viewuser:viewuser},
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