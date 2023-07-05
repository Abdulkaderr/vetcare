<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <link href="common/extranal/css/patient/patient.css" rel="stylesheet">
        <section class="">

            <header class="panel-heading">
                <?php if ($this->ion_auth->in_group(array('Owner'))) {
                    echo lang('my_pets');
                } else { ?>
                    <?php echo lang('patient'); ?> <?php echo lang('database');
                                                 ?>
                <div class="col-md-4 no-print pull-right">
                    <a data-toggle="modal" <?php if ($owner_idd == 0) { ?> href="#myModal" <?php } ?> id="mymodalbtn">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                            </button>
                        </div>
                    </a>
                </div>
                <?php }?>
            </header>
            <div class="panel-body">

                <div class="adv-table editable-table ">
<input type="hidden" name="owner_idd" value="<?php echo $owner_idd; ?>" id="owner_idd" />
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" <?php if ($owner_idd == 0) { ?> id="editable-sample" <?php } else { ?> id="editable-sample1" <?php } ?>>
                        <thead>
                            <tr>
                                <th><?php echo lang('patient_id'); ?></th>
                                <th><?php echo lang('blood_group'); ?></th>
                                <th><?php echo lang('patient'); ?> <?php echo lang('name'); ?></th>
                                <th><?php echo lang('owner'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th><?php echo lang('nid'); ?></th>
                                <th><?php echo lang('pet_num'); ?></th>
                                 <?php if ($this->ion_auth->in_group(array( 'admin','Accountant', 'Receptionist'))) { ?>
                                  <th><?php echo lang('due_balance'); ?></th>
                                <?php } ?> 
                                <th class="no-print"><?php echo lang('options'); ?></th>
                                    <?php if($this->ion_auth->in_group(array('admin'))){ ?>
                               
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->




<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('register_new_patient'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="addnewpatient" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" id="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                                                                if (!empty($patient->bloodgroup)) {
                                                                                    if ($group->group == $patient->bloodgroup) {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>> <?php echo $group->group; ?> </option>
                            <?php } ?>
                        </select> 
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" id="sex" value=''>

                            <option value="Male" <?php
                                                    if (!empty($patient->sex)) {
                                                        if ($patient->sex == 'Male') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> Male </option>
                            <option value="Female" <?php
                                                    if (!empty($patient->sex)) {
                                                        if ($patient->sex == 'Female') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> Female </option>
                        </select>
                    </div>

                    <div class="form-group col-md-6" id="male_fruitleness">
                        <label for="fruitleness"><?php echo 'Neuterled'; ?></label>
                        <input type="checkbox"  name="fruitleness" value='1' placeholder="">
                    </div>

                    <div class="form-group col-md-6" id="female_fruitleness">
                        <label for="fruitleness"><?php echo 'spayed'; ?></label>
                        <input type="checkbox"  name="fruitleness" value='1' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &#42;</label>
                        <input type="text" class="form-control" name="name" value='' placeholder="" required="">
                    </div>




                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?> &#42;</label>
                        <input type="text" class="form-control" name="address" value='' placeholder="" required="">
                    </div>


                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" required="" onkeypress="return false;">
                    </div>

                    <div class="form-group col-md-6">
                        <label><?php echo lang('strain'); ?></label>
                        <input class="form-control form-control-inline input-medium " type="text" name="p_strain" value=""
                         placeholder="Pet strain">
                    </div>

                    <div class="form-group col-md-6">
                        <label><?php echo lang('color'); ?></label>
                        <input class="form-control form-control-inline input-medium " type="text" name="p_color" value=""
                         placeholder="Pet color">
                    </div>

                    <div class="form-group col-md-6">
                        <label><?php echo lang('phone'); ?></label>
                        <input class="form-control form-control-inline input-medium " type="text" name="phone" value=""
                         placeholder="" required="">
                    </div>


                    <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                        <?php $doctor_ion_id = $this->ion_auth->get_user_id();
                        $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id; ?>
                        <input type="hidden" name="doctor" value="<?php echo $doctor_id; ?>">
                    <?php } else { ?>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                            <select class="form-control m-bot15" id="doctorchoose1" name="doctor" value=''>

                            </select>
                        </div>

                    <?php } ?>

                    <?php if ($this->ion_auth->in_group(array('Owner'))) { ?>
                        <?php $owner_ion_id = $this->ion_auth->get_user_id();
                        $owner_id = $this->db->get_where('owner', array('ion_user_id' => $owner_ion_id))->row()->id; ?>
                        <input type="hidden" name="owner" value="<?php echo $owner_id; ?>">
                    <?php } else { ?>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('pet_owner'); ?></label>
                            <?php if ($owner_idd == 0) { ?>
                            <select class="form-control m-bot15 owner_select" id="owner_select" name="owner" value=''>

                            </select>

                            <?php } else { ?>
                                <input type="hidden" name="owner_name" id="owner_name11" value="<?php echo $owner_name; ?>" />
                                <input type="hidden" name="owner_nid" id="owner_nid11" value="<?php echo $owner_nid; ?>" />
                                <input type="hidden" name="owner_phone" id="owner_phone11" value="<?php echo $owner_phone; ?>" />
                            <select class="form-control m-bot15" id="owner_select3" name="owner" >


                            </select>

                            <?php } ?>
                        </div>
                    <?php } ?>


                    <div class="pos_client clearfix">
                        <div class="col-md-6 payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('owner'); ?> <?php echo lang('name'); ?> &#42;</label>
                            <input type="text" class="form-control pay_in" name="owner_name" value='<?php
                                                                                                if (!empty($payment->p_name)) {
                                                                                                    echo $payment->p_name;
                                                                                                }
                                                                                                ?>' placeholder="">

                        </div>
                        <div class="col-md-6 payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('owner'); ?> <?php echo lang('email'); ?> &#42;</label>
                            <input type="text" class="form-control pay_in" name="owner_email" value='<?php
                                                                                                    if (!empty($payment->p_email)) {
                                                                                                        echo $payment->p_email;
                                                                                                    }
                                                                                                    ?>' placeholder="">
                        </div>
                        <div class="col-md-6 payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('owner'); ?> <?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control pay_in" name="owner_phone" value='<?php
                                                                                                    if (!empty($payment->p_phone)) {
                                                                                                        echo $payment->p_phone;
                                                                                                    }
                                                                                                    ?>' placeholder="">
                        </div>

                        <div class="col-md-6 payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('owner'); ?> <?php echo lang('nid'); ?></label>
                            <input type="text" class="form-control pay_in" name="nid" value='<?php
                                                                                                if (!empty($payment->p_age)) {
                                                                                                    echo $payment->p_age;
                                                                                                }
                                                                                                ?>' placeholder="">
                        </div>
                    </div>





                    <div class="form-group last col-md-6" id="pet_img">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class">
                                    <img src="" alt="" />

                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url" />
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- <div class="form-group col-md-6">
                        <input type="checkbox" name="sms" value="sms"> <?php // echo lang('send_sms') ?><br>
                    </div> -->


                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->






<?php if($this->ion_auth->in_group(array('admin','Doctor'))){ ?>

<!-- Edit Patient Modal-->
<div class="modal fade" id="myModalEdit" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('edit_patient'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editPatientForm" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                                                                if (!empty($patient->bloodgroup)) {
                                                                                    if ($group->group == $patient->bloodgroup) {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>> <?php echo $group->group; ?> </option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" id="edit_sex" value=''>

                            <option value="Male" <?php
                                                    if (!empty($patient->sex)) {
                                                        if ($patient->sex == 'Male') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> Male </option>
                            <option value="Female" <?php
                                                    if (!empty($patient->sex)) {
                                                        if ($patient->sex == 'Female') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> Female </option>
                        </select>
                    </div>



                    <div class="form-group col-md-6" id="edit_male_fruitleness">
                        <label for="fruitleness"><?php echo 'Neuterled'; ?></label>
                        <input type="checkbox"  name="fruitleness" value='1' placeholder="">
                    </div>

                    <div class="form-group col-md-6" id="edit_female_fruitleness">
                        <label for="fruitleness"><?php echo 'spayed'; ?></label>
                        <input type="checkbox"  name="fruitleness" value='1' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &#42;</label>
                        <input type="text" class="form-control" name="name" value='' placeholder="" required="">
                    </div>





                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?> &#42;</label>
                        <input type="text" class="form-control" name="address" value='' placeholder="" required="">
                    </div>


                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" 
                        name="birthdate" value="" placeholder="" required="" onkeypress="return false;">
                    </div>

                    <div class="form-group col-md-6">
                        <label><?php echo lang('strain'); ?></label>
                        <input class="form-control form-control-inline input-medium " type="text" name="p_strain" value=""
                         placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label><?php echo lang('color'); ?></label>
                        <input class="form-control form-control-inline input-medium " type="text" name="p_color" value=""
                         placeholder="">
                    </div>



                    <div class="form-group col-md-6">
                        <label><?php echo lang('phone'); ?></label>
                        <input class="form-control form-control-inline input-medium " type="text" name="phone" value=""
                         placeholder="" required="">
                    </div>
                 

                    <div class="form-group col-md-6">
                    <input type="hidden" name="owner_iddd" id="owner_iddd" value="<?php echo $owner_idd; ?>" />
                        <label for="exampleInputEmail1"><?php echo lang('pet_owner'); ?></label>
                        <select class="form-control m-bot15" id="owner_select1" name="owner" value=''>


                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <!-- <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label> -->
                        <!-- <select class="form-control m-bot15" id="doctorchoose" name="doctor" value=''> -->

                        <!-- </select> -->
                        <input type="hidden" name="doctor" id="doctorchoose" value="<?php echo $doctors->id; ?>">

                    </div>
                    <div class="form-group last col-md-6">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class">
                                    <img src="" id="img" alt="" />

                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url" />
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- <div class="form-group col-md-6">
                        <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                    </div> -->

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value='<?php
                                                            if (!empty($patient->patient_id)) {
                                                                echo $patient->patient_id;
                                                            }
                                                            ?>'>





                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>

                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<!-- Edit Patient Modal-->
<?php } ?>










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
        $('#bloodgroup').on('change', function() {
            if ($(this).val() == 'Dog' || $(this).val() == 'Cat' || $(this).val() == 'Horse') {
                $('#pet_img').fadeIn(500);
            }
            if ($(this).val() == 'Cow' || $(this).val() == 'Goat' || $(this).val() == 'Sheep') {
                $('#pet_img').fadeOut(500);
            }
        });
    });
</script>