

$(document).ready(function(){

  function load_unseen_notification(view = '')
  {
    $.ajax({
    url:"fetch_messages_admin.php",
    method:"POST",
    data:{view:view},
    dataType:"json",
    success:function(data)
    {
      $('.wadah-messages-dropdown').html(data.notification);
      if(data.unseen_notification > 0){
        $('.messages-count').html(data.unseen_notification);
      }
    }
    });
  }
  
  load_unseen_notification();
  
  setInterval(function(){ 
    load_unseen_notification();; 
  }, 5000);
  
});
