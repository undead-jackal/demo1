$(document).ready(function(){
  // $(document).on('blur', '.autocomplete_name', function(e){
  //   setTimeout(function () {
  //     $(this).parent().find(".drp-focus").css("visibility", "hidden!import");
  //     alert();
  //   }, 1000);
  // })
  //



  //
  // $(document).on('keyup','.autocomplete_name',function(e) {
  //   var self = $(this);
  //   $.simpletSubmit({
  //     url:"/autocompleteHelper",
  //     data:{
  //       key: $(this).val()
  //     },
  //     callback:function(data) {
  //       var str = "";
  //       self.parent().find(".drp-focus").css("visibility", "visible");
  //
  //       if (data.result.length != 0) {
  //         $(data.result).each(function(i, val){
  //           str += "<a data-id='"+val.id+"' class='dropdown-item autocomplete_item' href='#'>";
  //               str += val.name;
  //           str += "</a>";
  //         })
  //       }else {
  //           str += "<a class='dropdown-item' href='#'>";
  //               str += "No Result";
  //           str += "</a>";
  //       }
  //       self.parent().find(".drp-focus").html(str);
  //     }
  //   })
  // })
})

function showNotification(from, align, message, type) {
  $.notify({
      icon: "nc-icon nc-app",
      message: message

  }, {
      type: type,
      timer: 8000,
      placement: {
          from: from,
          align: align
      }
  });
}
