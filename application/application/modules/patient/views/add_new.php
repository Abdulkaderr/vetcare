<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <link href="common/extranal/css/patient/add_new.css" rel="stylesheet">
        <section class="panel">
            <header class="panel-heading col-md-7">
                <?php
                if (!empty($patient->id))
                    echo lang('edit_patient');
                else
                    echo lang('add_new_patient');
                ?>
            </header>
            <div class="panel-body col-md-7">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="patient/addNew" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                                            <select class="form-control m-bot15" name="bloodgroup" value=''>
                                                <?php foreach ($groups as $group) { ?>
                                                    <option value="<?php echo $group->group; ?>" <?php
                                                                                                    if (!empty($setval)) {
                                                                                                        if ($group->group == set_value('bloodgroup')) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    if (!empty($patient->bloodgroup)) {
                                                                                                        if ($group->group == $patient->bloodgroup) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>> <?php echo $group->group; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('name'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="name" value='<?php
                                                                                                        if (!empty($setval)) {
                                                                                                            echo set_value('name');
                                                                                                        }
                                                                                                        if (!empty($patient->name)) {
                                                                                                            echo $patient->name;
                                                                                                        }
                                                                                                        ?>' placeholder="" required="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                                            <select class="form-control m-bot15" name="sex" value=''>
                                                <option value="Male" <?php
                                                                        if (!empty($setval)) {
                                                                            if (set_value('sex') == 'Male') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        if (!empty($patient->sex)) {
                                                                            if ($patient->sex == 'Male') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>> Male </option>
                                                <option value="Female" <?php
                                                                        if (!empty($setval)) {
                                                                            if (set_value('sex') == 'Female') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        if (!empty($patient->sex)) {
                                                                            if ($patient->sex == 'Female') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>> Female </option>

                                            </select>
                                        </div>









                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('address'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="address" value='<?php
                                                                                                            if (!empty($setval)) {
                                                                                                                echo set_value('address');
                                                                                                            }
                                                                                                            if (!empty($patient->address)) {
                                                                                                                echo $patient->address;
                                                                                                            }
                                                                                                            ?>' placeholder="" required="">
                                        </div>



                                        <div class="form-group">
                                            <label><?php echo lang('birth_date'); ?></label>
                                            <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="<?php
                                                                                                                                                                    if (!empty($setval)) {
                                                                                                                                                                        echo set_value('birthdate');
                                                                                                                                                                    }
                                                                                                                                                                    if (!empty($patient->birthdate)) {
                                                                                                                                                                        echo $patient->birthdate;
                                                                                                                                                                    }
                                                                                                                                                                    ?>" placeholder="">
                                        </div>


                                        <div class="form-group">

                                            <div class="">
                                                <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                                            </div>
                                            <div class="">
                                                <select class="form-control m-bot15 js-example-basic-single" name="doctor" value=''>
                                                    <?php foreach ($doctors as $doctor) { ?>
                                                        <option value="<?php echo $doctor->id; ?>" <?php
                                                                                                    if (!empty($patient->doctor)) {
                                                                                                        if ($patient->doctor == $doctor->id) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>><?php echo $doctor->name; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>



                                        <?php if ($this->ion_auth->in_group(array('Owner'))) { ?>
                                            <?php $owner_ion_id = $this->ion_auth->get_user_id();
                                            $owner_id = $this->db->get_where('owner', array('ion_user_id' => $owner_ion_id))->row()->id; ?>
                                            <input type="hidden" name="owner" value="<?php echo $owner_id; ?>">
                                        <?php } else { ?>
                                            <div class="form-group">

                                                <div class="">
                                                    <label for="exampleInputEmail1"><?php echo lang('pet_owner'); ?></label>
                                                </div>
                                                <div class="">
                                                    <select class="form-control m-bot15 js-example-basic-single" name="owner" value=''>
                                                        <?php foreach ($owners as $owner) { ?>
                                                            <option value="<?php echo $owner->id; ?>" <?php
                                                                                                        if (!empty($patient->owner)) {
                                                                                                            if ($patient->owner == $owner->id) {
                                                                                                                echo 'selected';
                                                                                                            }
                                                                                                        }
                                                                                                        ?>><?php echo $owner->name; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div>
                                        <?php } ?>





                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                            <input type="file" name="img_url">
                                        </div>

                                        <?php if (empty($id)) { ?>

                                            <!-- <div class="form-group sms_send">
                                                <div class="payment_label">
                                                </div>
                                                <div class="">
                                                    <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                                                </div>
                                            </div> -->

                                        <?php } ?>

                                        <input type="hidden" name="id" value='<?php
                                                                                if (!empty($patient->id)) {
                                                                                    echo $patient->id;
                                                                                }
                                                                                ?>'>
                                        <input type="hidden" name="p_id" value='<?php
                                                                                if (!empty($patient->patient_id)) {
                                                                                    echo $patient->patient_id;
                                                                                }
                                                                                ?>'>
                                        <section class="">
                                            <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                        </section>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->