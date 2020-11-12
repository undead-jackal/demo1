<section id="main">
   <div class="row justify-content-md-center justify-content-sm-center justify-content-center">
       <div class="col-lg-6 col-md-12">
         <div class="alert alert-info alert-with-icon" data-notify="container">
             <span data-notify="icon" class="fas fa-info-circle"></span>
             <span data-notify="message">
                 <p class="text-justify" style="font-family:norwester; font-weight:bold; letter-spacing:1px">
                     This purpose of this project is to create an online enrollment system only for students.
                 </p>
                 <p class="text-justify" style="font-family:norwester; font-weight:bold; letter-spacing:1px">
                     This program serves only for the purpose of how far my knowledge in programming is as an entry level programmer. I will take any suggestions, recommendations, or criticisms for better coding, Thank you for your time.
                 </p>
             </span>
         </div>
       </div>
     <div class="card col-lg-7 col-md-7 col-sm-9">
        <div class="card-header">
           <h4>Online Enrollment</h4>
        </div>
        <div class="card-body">
           <div class="list-group">
             <?php foreach ($student as $key): ?>
                <div class="list-group-item list-group-item-action flex-column align-items-start ">
                     <div class="d-flex w-100 justify-content-between">
                       <h5 class="mb-1"><?= $key["last_name"] . "," . $key["first_name"] . " " . $key["middle_name"]?></h5>
                       <?php if (is_enrolled($key["id"])): ?>
                          <small class="badge badge-pill badge-success p-2">Enrolled</small>
                       <?php else: ?>
                          <small class="badge badge-pill badge-danger p-2">Not Enrolled</small>
                       <?php endif; ?>
                     </div>
                     <p class="mb-1 mt-1">You can click the button "Login" to test the enrollment system using this user. Or you can click the "Reset" to reset the data from this user </p>
                     <button type="button" class="btn btn-primary mr-4 login" data-user="<?= $key["username"] ?>" data-pass="<?= $key["password"] ?>" name="button">Login</button>
                     <?php if (is_enrolled($key["id"])): ?>
                        <button type="button" data-id="<?= $key["id"] ?>" class="btn btn-info reset" name="button">Reset</button>
                     <?php endif; ?>

                </div>
             <?php endforeach; ?>

           </div>
        </div>

     </div>
   </div>
</section>


<script type="text/javascript">
   $(document).ready(function() {
      $('.login').click(function(e){
         e.preventDefault();
         $.onlySubmit({
            url:"/handleLogin",
            data:{
               username : $(this).data("user"),
               password : $(this).data("pass")
            },
            callback: function(data) {
               console.log(data);
                  window.location.reload();
            }
         })
      })

      $('.reset').click(function(e){
         e.preventDefault();
         swal({
           title: "Are you sure?",
           text: "Resting will unenroll this student.",
           icon: "warning",
           buttons: true,
           dangerMode: true,
         })
         .then((willDelete) => {
           if (willDelete) {
                $.onlySubmit({
                  url:"/reset",
                  data:{
                     id : $(this).data("id"),
                  },
                  callback: function(data) {
                     console.log(data);
                     swal("Reseted", "success");
                     window.location.reload();
                  }
               })
           } else {
             swal("Plsease take time in filling up.");
           }
         });

      })
   })
</script>
