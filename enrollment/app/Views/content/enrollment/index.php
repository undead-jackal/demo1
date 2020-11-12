<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-md-center justify-content-sm-center justify-content-center">

       <?php if ($is_enrolled): ?>
          <div class="card col-lg-7 col-md-8 col-sm-9 col-9" style="padding:0px !important">
             <div class="card-header text-center" style="background:green; color:white">
                <h4> <i class="fas fa-check-circle"></i> ALREADY ENROLLED</h4>
             </div>
             <div class="card-body text-center">
                <p class="ml-auto mr-auto w-75" style="font-size:1.3rem">You are already enrolled. You an check your  study load on the "MY STUDYLOAD" page or click this link <br> <a href="<?= route_to("result") ?>">My Studyload</a> </p>
             </div>
          </div>
       <?php else: ?>
          <form id="studForm" class="col-lg-7 col-md-8 col-sm-9 col-9">
            <div id="student-info" class="card">
              <div class="card-header">
                Student Info
              </div>
              <div class="card-body">
                 <div class="alert alert-info alert-with-icon" data-notify="container">
                       <span data-notify="icon" class="fas fa-info-circle"></span>
                       <span data-notify="message">Review the form if any information is outdate please update it and click next.Make sure all of your information are correct.</span>
                 </div>

                <h5> <span style="color:red">*</span>  Personal Information</h5>
                <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">First Name</label>
                                <input class="form-control" type="text" name="fname" placeholder="enter first name" value="<?= $student["first_name"] ?>"/>
                          </div>
                      </div>

                      <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">Middle Name</label>
                                <input class="form-control" type="text" name="mname" placeholder="enter middle name not initial" value="<?= $student["middle_name"] ?>"/>
                          </div>
                      </div>

                      <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <input class="form-control" type="text" name="lname" placeholder="enter last name " value="<?= $student["last_name"] ?>"/>
                          </div>
                      </div>
                </div><!-- end -->
                <div class="row">
                      <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">Birthdate</label>
                                <input class="form-control" type="text" name="bday" value="<?= $student["bday"] ?>" placeholder="enter birthdate" />
                          </div>
                      </div>

                      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">Age</label>
                                <input class="form-control" type="text" placeholder="your age" name="age"/>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="form-group">
                                <label class="control-label">Sex</label>
                                <select class="form-control" name="sex">
                                   <?php if ($student["sex"] == "Male"): ?>
                                      <option selected value="">Male</option>
                                      <option value="">Female</option>
                                   <?php else: ?>
                                      <option value="">Male</option>
                                      <option selected value="">Female</option>
                                   <?php endif; ?>

                                </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">Civil Status</label>
                                <select class="form-control" name="status">
                                   <?php if ($student["status"] == "Single  "): ?>
                                      <option selected value="">Single</option>
                                      <option value="">Married</option>
                                   <?php else: ?>
                                      <option value="">Single</option>
                                      <option selected value="">Married</option>
                                   <?php endif; ?>
                                </select>
                          </div>
                      </div>
                </div><!-- end -->
                <hr>
                <h5> <span style="color:red">*</span>  Address</h5>
                <div class="row">
                   <?php $address_m = json_decode($student["address_city"]) ?>
                      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">Barangay</label>
                                <input class="form-control" type="text" name="m_address[]" placeholder="enter Barangay" value="<?=$address_m[0] ?>"/>
                          </div>
                      </div>

                      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">Sitio / Unit #</label>
                                <input class="form-control" type="text" name="m_address[]" placeholder="enter Sitio" value="<?=$address_m[1] ?>"/>
                          </div>
                      </div>

                      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">City</label>
                                <input class="form-control" type="text" name="m_address[]" placeholder="enter City" value="<?=$address_m[2] ?>"/>
                          </div>
                      </div>

                      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">Zip</label>
                                <input class="form-control" type="text" name="m_address[]" placeholder="enter Zip" value="<?=$address_m[3] ?>"/>
                          </div>
                      </div>
                </div><!-- end -->
                <h5>Provincial Address</h5>
                <div class="row">
                   <?php $address_p = json_decode($student["address_pro"]) ?>

                      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">Barangay</label>
                                <input class="form-control" type="text" name="p_address[]" placeholder="enter Barangay" value="<?= $address_p[0] ?>"/>
                          </div>
                      </div>

                      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">Sitio / Unit #</label>
                                <input class="form-control" type="text" name="p_address[]" placeholder="enter Sitio" value="<?= $address_p[1] ?>"/>
                          </div>
                      </div>

                      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">City</label>
                                <input class="form-control" type="text" name="p_address[]" placeholder="enter City" value="<?= $address_p[2] ?>"/>
                          </div>
                      </div>

                      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                          <div class="form-group">
                                <label class="control-label">Zip</label>
                                <input class="form-control" type="text" name="p_address[]" placeholder="enter Zip" value="<?= $address_p[3] ?>"/>
                          </div>
                      </div>
                </div><!-- end -->
                <hr>
                <h5> <span style="color:red">*</span>  Contact Information</h5>
                <div class="row">
                   <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                      <div class="form-group">
                           <label class="control-label">Email Address</label>
                           <input class="form-control" type="text" name="email" placeholder="enter Email" value="<?= $student["email"] ?>"/>
                      </div>
                   </div>
                   <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                      <div class="form-group">
                           <label class="control-label">Phone Number(Primary)</label>
                           <input class="form-control" type="text" name="phone1" placeholder="enter Phone number" value="<?= $student["phone"] ?>"/>
                      </div>
                   </div>
                </div>
              </div>
              <div class="card-footer">
                 <button type="button" class="btn btn-primary " name="button">Cancel</button>
                 <button type="button" class="btn btn-primary submit" name="button">Save & Next</button>
              </div>
            </div>
          </form>

          <form id="subForm" class="col-lg-12 col-md-12 col-sm-12 col-12" style="display:none">
             <div class="row justify-content-md-center justify-content-sm-center justify-content-center">
               <div class="col-lg-6 col-md-6 col-sm-12 mr-4 time-parent">
                  <div id="timesheet" class="card">
                   <div class="card-header">
                      Timesheet
                   </div>
                   <div class="card-body">
                      <table id="timsheetTable" class="table">
                          <thead>
                             <th>Time</th>
                             <th>Day</th>
                             <th>Subject Code</th>
                             <th>Unit</th>
                          </thead>
                          <tbody>
                             <?php foreach ($timesheet as $key): ?>
                                <tr data-sub="" data-id=<?= $key['id']?>>
                                   <input type="hidden" name="time[]" value="<?= $key['id']?>">
                                   <input type="hidden" class="subject_input" name="sub[]" value="">
                                   <td><?= $key['start_time']." - ". $key['end_time'] ?></td>
                                   <td><?= $key['days'] ?></td>
                                   <td class="subject"></td>
                                   <td class="unit"></td>
                                </tr>
                             <?php endforeach; ?>
                        </tbody>
                      </table>
                   </div>
                   <div class="card-footer">
                      <button type="button" class="btn-primary btn enroll" name="button">Enroll</button>
                   </div>
                </div>
               </div>
               <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                  <div id="subjects" class="card">
                     <div class="card-header">
                        Subject
                     </div>
                     <div class="card-body">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-12 div-card">
                             <ul id="subjects_time" class="list-group"></ul>
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
             </div>
          </form>
       <?php endif; ?>

      </div>
    </div>
</section>

<script src="<?= getAssets("js/enrollment.js") ?>" charset="utf-8"></script>
