<section class="content">
    <div class="container-fluid">
      <div  class="row justify-content-md-center justify-content-sm-center justify-content-center">
         <?php if (!$enroll): ?>
            <div class="card col-lg-7 col-md-8 col-sm-9 col-9" style="padding:0px !important">
              <div class="card-header text-center" style="background:red; color:white">
                 <h4> <i class="fas fa-check-circle"></i> NOT ENROLLED</h4>
              </div>
              <div class="card-body text-center">
                 <p class="ml-auto mr-auto w-75" style="font-size:1.3rem">You are not yet enroledl go to "Enroll" page or click this link <br> <a href="<?= route_to("Enroll") ?>">Enroll</a> </p>
              </div>
           </div>
         <?php else: ?>
         <div id="result" class="card col-lg-7 col-md-7 col-sm-12 col-12">
            <div class="card-header">
               <h5>Study Load</h5>
            </div>
            <div class="card-body">
               <?php foreach (json_decode($enroll['json_subjects']) as $key): ?>
                  <div class="list-group">
                     <?php foreach (json_decode($key) as $inner_key): ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start ">
                             <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1"><?= $inner_key->code ?></h5>
                              <small> <b><?= $inner_key->unit ?> Units</b> | <b> <?= strtoupper($inner_key->room) ?></b> </small>
                             </div>
                             <p class="mb-1"> <strong> <?= $inner_key->start_time ?> - <?= $inner_key->end_time ?> </strong> </p>
                        </div>
                     <?php endforeach; ?>
                  </div>
               <?php endforeach; ?>

            </div>
         </div>
         <?php endif; ?>


      </div>
   </div>
</section>
