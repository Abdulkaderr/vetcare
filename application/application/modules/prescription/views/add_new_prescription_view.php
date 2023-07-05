<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
    $doctordetails = $this->db->get_where('doctor', array('id' => $doctor_id))->row();
}
?>


<section id="main-content">
    <section class="wrapper site-min-height">
        <link href="common/extranal/css/prescription/add_new_prescription_view.css" rel="stylesheet">
        <section class="col-md-8">
            <header class="panel-heading">
                <?php
                if (!empty($prescription->id))
                    echo lang('edit_prescription');
                else
                    echo lang('add_prescription');
                ?>
            </header>
            <div class="panel col-md-12">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="prescription/addNewPrescription" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &#42;</label>
                                    <input type="text" class="form-control default-date-picker readonly" name="date" value='<?php
                                                                                                                            if (!empty($setval)) {
                                                                                                                                echo set_value('date');
                                                                                                                            }
                                                                                                                            if (!empty($prescription->date)) {
                                                                                                                                echo date('d-m-Y', $prescription->date);
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> &#42;</label>
                                    <select class="form-control m-bot15" id="patientchoose" name="patient" value='' required="">
                                        <?php if (!empty($prescription->patient)) { ?>
                                            <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> - (<?php echo lang('id'); ?> : <?php echo $patients->id; ?>)</option>
                                        <?php } ?>
                                        <?php
                                        if (!empty($setval)) {
                                            $patientdetails = $this->db->get_where('patient', array('id' => set_value('patient')))->row();
                                        ?>
                                            <option value="<?php echo $patientdetails->id; ?>" selected="selected"><?php echo $patientdetails->name; ?> - (<?php echo lang('id'); ?> : <?php echo $patientdetails->id; ?>)</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <?php if (!$this->ion_auth->in_group('Doctor')) { ?>
                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?></label>
                                        <input type="hidden" name="doctor" id="doctorchoose" value="<?php echo $doctors->id; ?>">


                                        <?php if (!empty($prescription->doctor)) { ?>
                                        <?php } ?>
                                        <?php
                                        if (!empty($setval)) {
                                            $doctordetails1 = $this->db->get_where('doctor', array('id' => set_value('doctor')))->row();
                                        ?>
                                        <?php }
                                        ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group col-md-4">
                                        <!-- <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?></label> -->
                                        <?php if (!empty($prescription->doctor)) { ?>

                                            <input type="hidden" name="doctor" id="doctorchoose" value="<?php echo $doctors->id; ?>">
                                        <?php } else { ?>
                                            <?php if (!empty($prescription->doctor)) { ?>
                                                <input type="hidden" name="doctor" id="doctorchoose1" value="<?php echo $doctors->id; ?>">
                                            <?php } ?>
                                            <?php if (!empty($doctordetails)) { ?>
                                                <input type="hidden" name="doctor" id="doctorchoose1" value="<?php echo $doctordetails->id; ?>">

                                            <?php } ?>
                                            <?php
                                            if (!empty($setval)) {
                                                $doctordetails1 = $this->db->get_where('doctor', array('id' => set_value('doctor')))->row();
                                            ?>
                                                <input type="hidden" name="doctor" id="doctorchoose1" value="<?php echo $doctordetails1->id; ?>">

                                            <?php }
                                            ?>

                                        <?php } ?>



                                    </div>
                                <?php } ?>

                                <div class="form-group col-md-6">
                                    <label class="control-label"><?php echo lang('treatment'); ?></label>
                                    <textarea class="form-control ckeditor" id="editor1" name="symptom" value="" rows="50" cols="20"><?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('symptom');
                                                                                                                                        }
                                                                                                                                        if (!empty($prescription->symptom)) {
                                                                                                                                            echo $prescription->symptom;
                                                                                                                                        }
                                                                                                                                        ?></textarea>
                                </div>



                                <div class="form-group col-md-6">
                                    <label class="control-label"><?php echo lang('note'); ?></label>
                                    <textarea class="form-control ckeditor" id="editor3" name="note" value="" rows="30" cols="20"><?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('note');
                                                                                                                                    }
                                                                                                                                    if (!empty($prescription->note)) {
                                                                                                                                        echo $prescription->note;
                                                                                                                                    }
                                                                                                                                    ?></textarea>
                                </div>

                                <div class="form-group col-md-12 medicine_block">
                                    <label class="control-label col-md-3"> <?php echo lang('medicine'); ?></label>
                                    <div class="col-md-9 medicine_div">
                                        <?php if (empty($prescription->medicine)) { ?>
                                            <select class="form-control m-bot15 medicinee" id="my_select1_disabled" name="category" value=''>

                                            </select>
                                        <?php } else { ?>
                                            <select name="category" class="form-control m-bot15 medicinee" multiple="multiple" id="my_select1_disabled">
                                                <?php
                                                if (!empty($prescription->medicine)) {


                                                    $prescription_medicine = explode('###', $prescription->medicine);
                                                    foreach ($prescription_medicine as $key => $value) {
                                                        $prescription_medicine_extended = explode('***', $value);
                                                        $medicine = $this->medicine_model->getMedicineById($prescription_medicine_extended[0]);
                                                ?>
                                                        <option value="<?php echo $medicine->id . '*' . $medicine->name; ?>" <?php echo 'data-dosage="' . $prescription_medicine_extended[1] . '"' . 'data-frequency="' . $prescription_medicine_extended[2] . '"data-days="' . $prescription_medicine_extended[3] . '"data-instruction="' . $prescription_medicine_extended[4] . '"'; ?> selected="selected">
                                                            <?php echo $medicine->name; ?>
                                                        </option>

                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 panel-body medicine_block">
                                    <label class="control-label col-md-3"><?php echo lang('medicine'); ?></label>
                                    <div class="col-md-9 medicine pull-right">

                                    </div>

                                </div>
                                <div class="form-group col-md-12 panel-body lab_test">

                                    <!-- lab template -->

                                    <!-- <div class="col-md-6 lab pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('lab_tests'); ?></label>
                                        <select class="form-control m-bot15 js-example-basic-multiple template" id="template" name="template" value=''>
                                            <option value="">Select .....</option>
                                            <?php foreach ($templates as $template) { ?>
                                                <option value="<?php echo $template->id; ?>"><?php echo $template->name; ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div> -->

                                    <!-- lab report -->

                                    <!-- <div class="col-md-12 lab pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('report'); ?></label>
                                        <textarea class="ckeditor form-control" id="editor" name="report" value="" rows="10"><?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    echo set_value('report');
                                                                                                                                }
                                                                                                                                if (!empty($lab->report)) {
                                                                                                                                    echo $lab->report;
                                                                                                                                }
                                                                                                                                ?>
                                </textarea>
                                    </div> -->

                                    <!-- </div> -->

                                    <!-- ///////////////////////////////////////// -->
<!-- 


                                    <div class="col-md-12 lab pad_bot">
                                        <label for="exampleInputEmail1"><?php echo lang('lab_test'); ?> <?php echo lang('title'); ?></label>
                                        <input type="text" class="form-control pay_in" name="title" value='<?php
                                                                                                            if (!empty($lab_single->title)) {
                                                                                                                echo  $lab_single->title;
                                                                                                            }
                                                                                                            ?>' placeholder="">
                                    </div>

                                    <div class="">



                                        <div class="col-md-6 lab pad_bot">
                                           
                                            <input type="hidden" name="doctor" id="add_doctor" value="<?php echo $doctor_id; ?>">

                                        </div>

                                        <div class="col-md-6 lab pad_bot">
                                            <label for="exampleInputEmail1">
                                                <?php echo lang('template'); ?>
                                            </label>
                                            <select class="form-control m-bot15 js-example-basic-multiple template" id="template" name="template" value=''>
                                                <option value="">Select .....</option>
                                                <?php foreach ($templates as $template) { ?>
                                                    <option value="<?php echo $template->id; ?>"><?php echo $template->name; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="pos_doctor">
                                            <div class="col-md-8 lab pad_bot">
                                                <div class="col-md-3 lab_label">
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('name'); ?></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control pay_in" name="d_name" value='<?php
                                                                                                                        if (!empty($lab_single->p_name)) {
                                                                                                                            echo $lab_single->p_name;
                                                                                                                        }
                                                                                                                        ?>' placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-8 lab pad_bot">
                                                <div class="col-md-3 lab_label">
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('email'); ?></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control pay_in" name="d_email" value='<?php
                                                                                                                            if (!empty($lab_single->p_email)) {
                                                                                                                                echo $lab_single->p_email;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-8 lab pad_bot">
                                                <div class="col-md-3 lab_label">
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('phone'); ?></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control pay_in" name="d_phone" value='<?php
                                                                                                                            if (!empty($lab_single->p_phone)) {
                                                                                                                                echo $lab_single->p_phone;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8 panel">
                                        </div>



                                    </div>









                                    <div class="col-md-12 lab pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('report'); ?></label>
                                        <textarea class="ckeditor form-control" id="editor" name="report" value="" rows="10"><?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    echo set_value('report');
                                                                                                                                }
                                                                                                                                if (!empty($lab_single->report)) {
                                                                                                                                    echo $lab_single->report;
                                                                                                                                }
                                                                                                                                ?>
    </textarea>
                                    </div>
                                    <div class="col-md-12 lab pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('status'); ?></label>
                                        <select name="status" class="form-control js-example-basic-single" id="status">
                                            <option value="sample_taken" <?php if (!empty($lab_single->id)) {
                                                                                if ($lab_single->status == 'sample_taken') {
                                                                                    echo 'selected';
                                                                                }
                                                                            } ?>><?php echo lang('sample_collected'); ?></option>
                                            <option value="complete" <?php if (!empty($lab_single->id)) {
                                                                            if ($lab_single->status == 'complete') {
                                                                                echo 'selected';
                                                                            }
                                                                        } ?>><?php echo lang('completed'); ?></option>
                                            <option value="delivered" <?php if (!empty($lab_single->id)) {
                                                                            if ($lab_single->status == 'delivered') {
                                                                                echo 'selected';
                                                                            }
                                                                        } ?>><?php echo lang('delivered'); ?></option>
                                        </select>

                                    </div>
                                    <input type="hidden" name="redirect" value="<?php
                                                                                if (!empty($lab_single)) {
                                                                                    echo 'lab?id=' . $lab_single->id;
                                                                                } else {
                                                                                    echo 'lab';
                                                                                }
                                                                                ?>">

                                    <input type="hidden" name="id" value='<?php
                                                                            if (!empty($lab_single->id)) {
                                                                                echo $lab_single->id;
                                                                            }
                                                                            ?>'>


                                </div> -->

                                <!-- ///////////////////////////////////////// -->

                                <div class="form-group col-md-12">
                                    <label class="control-label"><?php echo lang('advice'); ?></label>
                                    <textarea class="form-control ckeditor" id="editor2" name="advice" value="" rows="30" cols="20"><?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('advice');
                                                                                                                                    }
                                                                                                                                    if (!empty($prescription->advice)) {
                                                                                                                                        echo $prescription->advice;
                                                                                                                                    }
                                                                                                                                    ?>
                                    </textarea>
                                </div>



                                <input type="hidden" name="admin" value='admin'>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($prescription->id)) {
                                                                            echo $prescription->id;
                                                                        }
                                                                        ?>'>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                                </div>
                            </div>

                            <div class="col-md-5">

                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_medicine = "<?php echo lang('medicine'); ?>";
</script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var lab_test = "<?php echo lang('lab_tests'); ?>";
</script>
<script src="common/extranal/js/prescription/add_new_prescription_view.js"></script>
<!-- <script src="common/extranal/js/lab/add_template_view.js"></script> -->
<script src="common/extranal/js/lab/add_lab_view.js"></script>