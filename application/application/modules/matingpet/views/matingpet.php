<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('all'); ?>
                <?php echo lang('missing_posts'); ?>
                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                    <div class="col-md-4 no-print pull-right">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group pull-right">
                                <button id="" class="btn green btn-xs">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_post'); ?>
                                </button>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('pet_type'); ?></th>
                                <th><?php echo lang('owner'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Owner'))) { ?>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
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







<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_missing_post'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="matingpet/addMatingpet" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group last col-md-6">
                        <label class="control-label">Upload Image</label>
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
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <div class="form-group col-md-12 owner_div">
                            <label for="exampleInputEmail1"><?php echo lang('pet_owner'); ?></label>
                            <select class="form-control m-bot15 js-example-basic-single" id="owner" name="owner" value=''>
                               <option value=""> Select Owner</option>
                            <?php foreach ($owners as $owner) { ?>
                                    <option value="<?php echo $owner->id; ?>"><?php echo $owner->name; ?> </option>
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
                        <input type="hidden" name="owner" value="<?php echo $owner_id; ?>">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                            <select class="form-control m-bot15 js-example-basic-single" id="patient" name="patient" value=''>
                                <?php foreach ($patients as $patient) { ?>
                                    <option value="<?php echo $patient->id; ?>"> <?php echo $patient->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('pet_type'); ?></label>
                        <input type="text" class="form-control" name="type" value='' placeholder="" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast; </label>
                        <input type="number" class="form-control" name="phone" value='' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-12">
                        <label class=""> <?php echo lang('description') ?> &#42;</label>
                        <div class="">
                            <textarea class="ckeditor form-control" name="description" id="editor" value="" rows="10" required="">  </textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('edit_matingpet'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editMatingpetForm" class="clearfix" action="matingpet/addMatingpet" method="post" enctype="multipart/form-data">


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
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <div class="form-group col-md-12 owner_div1">
                            <label for="exampleInputEmail1"><?php echo lang('pet_owner'); ?></label>
                            <select class="form-control m-bot15 js-example-basic-single" id="owner1" name="owner" value=''>
                            <option value=""> Select Owner</option>
                            <?php foreach ($owners as $owner) { ?>
                                    <option value="<?php echo $owner->id; ?>"><?php echo $owner->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                            <select class="form-control m-bot15 js-example-basic-single" id="patient1" name="patient" value=''>

                            </select>
                        </div>
                    <?php } else { ?>
                        <?php $owner_ion_id = $this->ion_auth->get_user_id();
                        $owner_id = $this->db->get_where('owner', array('ion_user_id' => $owner_ion_id))->row()->id; ?>
                        <input type="hidden" name="owner" id="owner1" value="<?php echo $owner_id; ?>">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                            <select class="form-control m-bot15 js-example-basic-single" id="patient1" name="patient" value=''>
                                <?php foreach ($patients as $patient) { ?>
                                    <option value="<?php echo $patient->id; ?>"> <?php echo $patient->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('pet_type'); ?></label>
                        <input type="text" class="form-control" name="type" value='' placeholder="" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast; </label>
                        <input type="number" class="form-control" name="phone" value='' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-12">
                        <label class=""> <?php echo lang('description') ?> &#42;</label>
                        <div class="">
                            <textarea class="ckeditor form-control" name="description" id="editor1" value="" rows="10" required="">  </textarea>
                        </div>
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_deposit'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="addMatingpetDepositForm" action="finance/matingpetDeposit" id="deposit-form" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('matingpet'); ?> <?php echo lang('id'); ?></label>
                        <input type="text" class="form-control" name="matingpet_id" value='' placeholder="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('matingpet'); ?> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="matingpet_name" value='' placeholder="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('deposit_amount'); ?></label>
                        <input type="text" class="form-control" name="deposited_amount" value='' placeholder="">
                    </div>



                    <div class="form-group">
                        <div class="">
                            <label for="exampleInputEmail1"><?php echo lang('deposit_type'); ?></label>
                        </div>
                        <div class="">
                            <select class="form-control m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''>

                                <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                <option value="Card"> <?php echo lang('card'); ?> </option>


                            </select>
                        </div>



                    </div>



                    <input type="hidden" name="id" value=''>
                    <!-- <input type="text" name="payment_id" value=''> -->
                    <div class="form-group cashsubmit payment  right-six col-md-12">
                        <button type="submit" name="submit" id="submit" class="btn btn-info row pull-right"> <?php echo lang('submit'); ?></button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/matingpet.js"></script>