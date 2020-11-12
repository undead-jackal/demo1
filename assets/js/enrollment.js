$(document).ready(function() {
   subjects();
   var tempStorage =[];

   $(document).on("click",".submit",function(e) {
      e.preventDefault();
         swal({
           title: "Are you sure?",
           text: "Make sure all information is correct once you have enrolled you will need to go to the admin to change your information with the following. (affidavit and birth certificate)",
           icon: "warning",
           buttons: true,
           dangerMode: true,
         })
         .then((willDelete) => {
           if (willDelete) {
             $("#studForm").submit();
           } else {
             swal("Plsease take time in filling up.");
           }
         });
   })
   var data_enroll = [];

   $(document).on("click",".enroll",function(e) {
      e.preventDefault();
         swal({
           title: "Are you sure?",
           text: "Once Enroll Dropping may be impossible",
           icon: "warning",
           buttons: true,
           dangerMode: true,
         })
         .then((willDelete) => {
           if (willDelete) {
             $("#subForm").submit();
           } else {
             swal("Plsease take time in filling up.");
           }
         });
   })

   $("#subForm").submitform({
      url:'/enroll_now',
      additionalData:{
         data_enroll:JSON.stringify(data_enroll)
      },
      callback:  function(data){
          if (data) {
             swal({
              title: "Congratulations!",
              text: "Please attend your classes.",
              icon: "success",
              button: "okay",
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                 window.location.reload();
              }
            });
          }
      },
   })



   $('input[name="bday"]').datetimepicker({
       format: 'YYYY/MM/DD',
   }).on("dp.change", function (e) {
      var today = new Date();
      var birthDate = new Date($(this).val());
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
         age--;
      }
      $("input[name='age']").val(age);
      console.log(age);
   });

   var today = new Date();
   var birthDate = new Date($('input[name="bday"]').val());
   var age = today.getFullYear() - birthDate.getFullYear();
   var m = today.getMonth() - birthDate.getMonth();
   if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
   }
   $("input[name='age']").val(age);
   $("input[name='age']").val(age);

   $("#studForm").submitform({
      url:'/saveStud',
      callback:  function(data){
        if (data) {
           swal("Student Information", "Your information is updated", "success");
           swal({
            title: "Your Information Has been updated",
            text: "Proceed to subject plotting",
            icon: "success",
            button: "Proceed",
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
               $('#studForm').hide();
               $('#subForm').show();
            }
          });

        }
      },
   })


   $(document).on('click','.add-btn',function() {
      var btnData = $(this).data("id");
      var self = $(this);
      var sub_info = {
         time:btnData,
         sub:self.data("s_id")
      }
      tempStorage.push(sub_info);
      var sub_count=0;
      var sub_indexes = [];
      var sched_taken = false;

      $('#timsheetTable tbody tr').each(function(){
         if (btnData === $(this).data("id")) {
            if ($(this).find(".subject").html() != " " && $(this).find(".unit").html()) {
               sched_taken = true
            }
         }
      })
      if (!sched_taken) {
         for (var i = 0; i < tempStorage.length; i++) {
            if (tempStorage[i]["sub"] === self.data("s_id")) {
               sub_indexes.push(tempStorage[i]["time"]);
            }
         }
         var set_array = new Set(sub_indexes);
         sub_indexes = [...set_array]
         if (sub_indexes.length == 2) {
            var swap = null;
            $('#timsheetTable tbody tr').each(function(){
               if (sub_indexes[1] == $(this).data("id")) {
                  if ($(this).find(".subject").html() != " " && $(this).find(".unit").html()) {
                     swap = 1;
                  }
               }
               if (sub_indexes[0] == $(this).data("id")) {
                  if ($(this).find(".subject").html() != " " && $(this).find(".unit").html()) {
                     swap = 0;
                  }
               }
            });

            console.log(swap);
            if (swap == 0) {
               $('#timsheetTable tbody tr').each(function(){
                  if (sub_indexes[1] == $(this).data("id")) {
                     $(this).find(".subject_input").val(self.data("s_id"));
                     $(this).find(".subject").html(self.data("code"));
                     $(this).find(".unit").html(self.data("unit"));
                  }
                  if (sub_indexes[0] == $(this).data("id")) {
                     $(this).find(".subject_input").val("");
                     $(this).find(".subject").html("");
                     $(this).find(".unit").html("");
                  }
               });
            }else if(swap == 1){
               $('#timsheetTable tbody tr').each(function(){
                  if (sub_indexes[0] == $(this).data("id")) {
                     $(this).find(".subject_input").val(self.data("s_id"));
                     $(this).find(".subject").html(self.data("code"));
                     $(this).find(".unit").html(self.data("unit"));
                  }
                  if (sub_indexes[1] == $(this).data("id")) {
                     $(this).find(".subject_input").val("");
                     $(this).find(".subject").html("");
                     $(this).find(".unit").html("");
                  }
               });
            }
         }else {
            $('#timsheetTable tbody tr').each(function(){
               if (btnData === $(this).data("id")) {
                  $(this).find(".subject_input").val(self.data("s_id"));
                  $(this).find(".subject").html(self.data("code"));
                  $(this).find(".unit").html(self.data("unit"));
               }
            });
         }
      }else {
         swal("You got conflict!", "Choose another subject to fit the sched", "error");
      }
   })
})

function subjects() {
   $('#subjects_time').renderDisplay({
     url:"/displaySubjects",
     data:{
      per_page:999,
     },
     paginate:false,
     render:function(data) {
          const card =`
             <li class="list-group-item d-flex justify-content-between align-items-center">
               <div class="row" style="width:100%">
                  <div class="col-10">
                      <div class="d-flex w-100 justify-content-between">
                         <h6 class="mb-1">${data["code"]} | ${data["name"]}</h6>
                         <small>${data["unit"]} Units</small>
                      </div>
                      <small><b> ${data["start_time"]} - ${data["end_time"]} | ${data["days"]} | ${data["room"]} </b></small>
                  </div>
                  <div class="col-2 check-holder">
                     <button type="button" data-id="${data["time_id"]}" data-s_id="${data["sub"]}" data-code="${data["code"]}" data-unit="${data["unit"]}" class="btn-sm btn btn-round btn-primary add-btn" name="button"> <i class="fas fa-check"></i> </button>
                  </div>
               </div>
            </li>
          `;
          return card;
      },

   })
}
