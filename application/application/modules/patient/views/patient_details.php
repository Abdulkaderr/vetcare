<!--sidebar end-->
<!--main content start-->
<style>
    .pet_info p,h4 {
        padding: 2rem 0;
        border-bottom: 1px solid #eee;
    }

    .owner-info {
        padding-left: 3rem;
    }

    .pet-nav {
        border: 1px solid #aaa;
    }
    .pet-nav p {
        cursor: pointer;
        padding: 1rem 3rem;
        color: #337ecc;
    }

    .pet-nav div:first-child {
        border-bottom: 1px solid #aaa;
    }

    #tab2 {
        display: none;
    }
    .profile-info {
        padding-left: 3rem;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <link href="common/extranal/css/patient/patient.css" rel="stylesheet">
        <section class="">

            <header class="panel-heading">
                <p><i class="fa fa-user"></i> Medical File</p>
            </header>
            <div class="panel-body">
                <div class="row">
                    <aside class="profile-nav col-lg-3">
                        <section class="panel">
                            <div class="user-heading round">
                                <a>
                                    <img src="<?php echo $patient->img_url ?>" alt="">
                                </a>
                            </div>

                            <div class="pet-nav">
                                <div>
                                <p class="ptab1"><i class="fa fa-info-circle"></i> Information</p>
                                </div>
                                <div>
                                <p class="ptab2"><i class="fa fa-file-medical"></i> Vaccine</p>
                                </div>
                            </div>
                        </section>
                    </aside>


                    <aside class="profile-info col-lg-6">
                        <section class="panel">
                            <div class="tab current" id="tab1">
                                <h4><strong>Animal</strong> <br> Information</h4>

                                <div class="pet_info">
                                    <p>Animal Name: <?php echo $patient->name; ?></p>
                                    <p>Animal ID: <?php echo $patient->patient_number; ?></p>
                                    <p>Gender: <?php echo $patient->sex; ?></p>
                                    <p>Species: <?php echo $patient->blood_group; ?></p>
                                    <p>Breed: <?php echo $patient->strain; ?></p>
                                    <p>Color: <?php echo $patient->color; ?></p>
                                    <p>Date of Birth: <?php echo $patient->birthdate; ?></p>
                                    <p>Age: <?php
                                                $birthDate = strtotime($patient->birthdate);
                                                $birthDate = date('m/d/Y', $birthDate);
                                                $birthDate = explode("/", $birthDate);
                                                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                                                echo $age . ' Year(s)';
                                                ?></p>
                                    <p>Email: <?php echo $patient->email; ?></p>
                                    <p>Address: <?php echo $patient->address; ?></p>
                                    <p>Phone: <?php echo $patient->phone; ?></p>
                                    <p>Fruitleness: <?php echo $patient->fruitleness; ?></p>

                                </div>
                            </div>

                            <div class="tab" id="tab2">
                            
                                <div class="adv-table editable-table " style="margin-top: 1rem;">
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('bed_id'); ?></th>
                                                <th><?php echo lang('alloted_time'); ?></th>
                                                <th><?php echo lang('discharge_time'); ?></th>
                                                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                    <th><?php echo lang('view_more'); ?></th>
                                                <?php } else { ?>
                                                    <th></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>



                                            <?php foreach ($beds as $bed) {

                                            ?>
                                                <tr class="">
                                                    <td><?php echo $bed->bed_id; ?></td>
                                                    <td><?php echo $bed->a_time; ?></td>
                                                    <td><?php echo $bed->d_time; ?></td>
                                                    <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                        <td> <a class="btn btn-info btn-xs btn_width" href="bed/bedAllotmentDetails?id=<?php echo $bed->id; ?>"> <?php echo lang('more'); ?></a>
                                                            <?php if (!empty($bed->d_time)) { ?>
                                                                <a class="btn btn-info btn-xs btn_width" href="bed/dischargeReport?id=<?php echo $bed->id; ?>"> <?php echo lang('discharge_report'); ?></a>
                                                            <?php } ?>
                                                        </td>
                                                        <?php } else {
                                                        if (!empty($bed->d_time)) { ?>
                                                            <a class="btn btn-info btn-xs btn_width" href="bed/dischargeReport?id=<?php echo $bed->id; ?>"> <?php echo lang('discharge_report'); ?></a>
                                                        <?php } ?>
                                                    <?php    } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </aside>

                    <aside class="owner-info col-lg-3">
                        <section class="panel">
                            <h4 style="border:none;">Signalment</h4>

                            <div class="owner_info">
                                <p><i class="fa fa-hand-point-right"></i>   <strong>Owner Name</strong><br> <?php echo $owner->name; ?></p>
                                <p><i class="fa fa-hand-point-right"></i>   <strong>Owner ID</strong><br> <?php echo $owner->nid; ?></p>
                                <p><i class="fa fa-hand-point-right"></i>   <strong>Owner Phone</strong><br> <?php echo $owner->phone; ?></p>
                                <p><i class="fa fa-hand-point-right"></i>   <strong>Owner Address</strong><br> <?php echo $owner->address; ?></p>
                                

                            </div>
                        </section>
                    </aside>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->



<div class="modal fade" id="infoModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('patient'); ?> <?php echo lang('info'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group last col-md-4">
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class">
                                    <img src="" id="img1" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('patient_id'); ?>: <span class="patientIdClass"></span></label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('patient').' '.lang('name'); ?> </label>
                        <div class="nameClass"></div>
                    </div>


                    <!-- <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <div class="emailClass"></div>
                    </div> -->

                    <div class="form-group col-md-4">
                        <label><?php echo lang('age'); ?></label>
                        <div class="ageClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <div class="addressClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('gender'); ?></label>
                        <div class="genderClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <div class="phoneClass"></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo 'fruitleness'; ?></label>
                        <div class="fruitlenessClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <div class="bloodgroupClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('birth_date'); ?></label>
                        <div class="birthdateClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                    </div>
                    <div class="form-group col-md-4">
                        <label><?php echo lang('strain'); ?></label>
                        <div class="strainClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('color'); ?></label>
                        <div class="colorClass"></div>
                    </div>






                    <div class="form-group col-md-4">
                    </div>
                    <div class="form-group col-md-4">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <div class="doctorClass"></div>
                    </div>







                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>



<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/patient/patient.js"></script>
<script src="common/extranal/js/patient/fruitleness.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_owner = "<?php echo lang('select_owner'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

 <script>
    $(document).ready(function() {
        $('.ptab1').click(function() {
            if ($('#tab2').hasClass('current')) {
                $('#tab2').fadeOut(500);
                $('.current').removeClass('current');
                $('#tab1').addClass('current');
                $('#tab1').fadeIn(500);
            }
        });

        $('.ptab2').click(function() {
            if ($('#tab1').hasClass('current')) {
                $('#tab1').fadeOut(500);
                $('.current').removeClass('current');
                $('#tab2').addClass('current');
                $('#tab2').fadeIn(500);
            }
        });
    });
</script>