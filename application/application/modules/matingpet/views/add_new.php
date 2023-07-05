<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7 row">
            <header class="panel-heading">
                <?php
                if (!empty($matingpet->id))
                    echo lang('edit_matingpet');
                else
                    echo lang('add_matingpet');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table row">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="matingpet/addMatingpet" class="clearfix" method="post" enctype="multipart/form-data">
                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <div class="form-group col-md-12 owner_div">
                                    <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('owner'); ?> &ast; </label>
                                    <select class="form-control m-bot15" id="owner" name="owner" value=''>
                                        <option value=""> Select Owner</option>
                                        <?php foreach ($owners as $owner) { ?>
                                            <option value="<?php echo $owner->id; ?>" <?php

                                                                                        if (!empty($matingpet->owner)) {
                                                                                            if ($owner->id == $matingpet->owner) {
                                                                                                echo 'selected';
                                                                                            }
                                                                                        }
                                                                                        ?>> <?php echo $owner->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                                    <select class="form-control m-bot15 js-example-basic-single" id="patient" name="patient" value=''>

                                    </select>
                                </div>
                            <?php } else { ?>
                                <?php $owner_ion_id = $this->ion_auth->get_user_id();
                                $owner_id = $this->db->get_where('owner', array('ion_user_id' => $owner_ion_id))->row()->id; ?>
                                <input type="hidden" name="owner" value="<?php echo $owner_id;?>">
                                <div class="form-group col-md-12">
                                    <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                                    <select class="form-control m-bot15 js-example-basic-single" name="patient" value=''>
                                        <?php foreach ($patients as $patient) { ?>
                                            <option value="<?php echo $patient->id; ?>"> <?php echo $patient->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>


                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('type'); ?> &ast; </label>
                                <input type="text" class="form-control" name="type" value='<?php
                                                                                            if (!empty($setval)) {
                                                                                                echo set_value('pet_type');
                                                                                            }
                                                                                            if (!empty($matingpet->pet_type)) {
                                                                                                echo $matingpet->pet_type;
                                                                                            }
                                                                                            ?>' placeholder="" required>
                            </div>





                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast; </label>
                                <input type="text" class="form-control" name="phone" value='<?php
                                                                                            if (!empty($setval)) {
                                                                                                echo set_value('phone');
                                                                                            }
                                                                                            if (!empty($matingpet->phone)) {
                                                                                                echo $matingpet->phone;
                                                                                            }
                                                                                            ?>' placeholder="" required="">
                            </div>


                            <div class="form-group col-md-12">
                                <label class="control-label"><?php echo lang('description'); ?></label>
                                <textarea class="form-control ckeditor" id="editor1" name="description" value="" rows="50" cols="20"><?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('description');
                                                                                                                                        }
                                                                                                                                        if (!empty($prescription->description)) {
                                                                                                                                            echo $prescription->description;
                                                                                                                                        }
                                                                                                                                        ?></textarea>
                            </div>



                            <div class="form-group last col-md-12">
                                <label class="control-label">Image Upload</label>
                                <div class="">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail img_class">
                                            <img src="<?php

                                                        if (!empty($matingpet->img_url)) {
                                                            echo $matingpet->img_url;
                                                        }
                                                        ?>" id="img" alt="" />

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

                            <input type="hidden" name="id" value='<?php
                                                                    if (!empty($matingpet->id)) {
                                                                        echo $matingpet->id;
                                                                    }
                                                                    ?>'>

                            <div class="form-group col-md-12">
                                <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
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

<script>
    var myEditor1;
    $(document).ready(function() {

        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor1 => {
                editor1.ui.view.editable.element.style.height = '200px';
                myEditor1 = editor1;
            })
            .catch(error => {
                console.error(error);
            });





    });

    $(document).ready(function() {
        "use strict";
        $(".owner_div").on("change", "#owner", function() {
            "use strict";
            var owner = $("#owner").val();

            $("#patient").html(" ");

            $.ajax({
                url: "patient/getPatientByOwner?id=" + owner,
                method: "GET",
                data: "",
                dataType: "json",
                success: function(response1) {
                    $("#patient").html(response1.response).end();
                },
            });
        });
    });
</script>