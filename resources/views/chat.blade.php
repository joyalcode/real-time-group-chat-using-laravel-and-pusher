@extends('layout')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-sm-10 main">
         <div class="chat">
            <div class="messages"></div>
         </div>
         <div class="group-control">
            <input type="text" disabled placeholder="Please wait..." id="user_message" class="form-control">
            <button onclick="sendMessage()" disabled class="btn btn-primary pull-right btn-send" id="btn_send">Initializing</button>
         </div>
      </div>
      <div class="col-sm-2 sidebar">
         <h4><span class="glyphicon glyphicon-user"></span> Online Users </h4>
         <ul class="users">
         </ul>
      </div>
   </div>
</div>
<script src="//js.pusher.com/3.0/pusher.min.js"></script>
<script type="text/javascript">

var user_name = '';

var pusher = new Pusher('{{env("PUSHER_KEY")}}', {
    authEndpoint: '{{url("auth")}}',
    auth: {
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    }
});

Pusher.log = function(msg){
    console.log(msg);
}

var channel = pusher.subscribe('presence-chat');

channel.bind('pusher:subscription_succeeded', function() {
   channel.members.each(function(member) {
     var userId = member.id;
     var userName = member.info.name;
     $('.users').append('<li id='+userId+'>'+userName+'</li>');
   });

   var me = channel.members.me;
   user_name = me.info.name;

   $('#user_message').prop("disabled", false).attr("placeholder","Enter your message here").focus();
   $('#btn_send').prop("disabled", false).text('Send Message');

});


channel.bind('pusher:member_added', function(member) {
   var userName = member.info.name;
   var userId = member.id;
   $('.users').append('<li id='+userId+'>'+userName+'</li>');
   $('.messages').append('<div><i>'+userName+' joined discussion.<div></i>');
});


channel.bind('pusher:member_removed', function(member) {
   var userName = member.info.name;
   var userId = member.id;
   $('.users #'+userId).remove();
   $('.messages').append('<div><i>'+userName+' left discussion.</i><div>');
});


channel.bind('client-new-message', function(data) {
   $('.messages').append(data.message);
   $(".messages").animate({ scrollTop: $('.messages')[0].scrollHeight}, 1000);
})


function sendMessage() {
   var userMessage = $('#user_message').val();
   var userMessage = '<div><strong>'+user_name+': </strong>'+userMessage+'<div>'
   channel.trigger('client-new-message', { message : userMessage });
   $('#user_message').val('').focus();
   $('.messages').append(userMessage);
   $(".messages").animate({ scrollTop: $('.messages')[0].scrollHeight}, 1000);
}

$('#user_message').keypress(function(e){
   if(e.which == 13){
     $('#btn_send').click();
   }
});  

$('#logout').click(function(){
   pusher.unsubscribe('presence-chat');
   window.location = 'logout'
})

</script>
@endSection