$(document).ready(function() {
  $('#loginForm').submitform({
    url: "/handleLogin",
    callback: function(data){
      location.reload();
    }
  })
})
