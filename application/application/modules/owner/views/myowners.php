<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <link href="common/extranal/css/owner.css" rel="stylesheet">
        <script src="common/js/codearistos.min.js"></script>
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('myowners'); ?>
                <div class="clearfix no-print col-md-8 pull-right">
                    <div class="pull-right"></div>
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_pet_owner'); ?>
                            </button>
                        </div>
                    </a>

                </div>

                <div class="clearfix no-print col-md-4 pull-left">
                    <div class="pull-right"></div>
                    <a data-toggle="modal" href="#myModal1">
                        <div class="btn-group pull-right">
                            <button class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_exist_owner'); ?>
                            </button>
                        </div>
                    </a>

                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">

                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                        <thead>
                            <tr>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('address'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th><?php echo lang('nid'); ?></th>
                                <?php if($this->ion_auth->in_group(array('admin', 'Doctor'))){ ?>

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




<!-- Add Owner Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_pet_owner'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="owner/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for=""> <?php echo lang('name'); ?> &#42;</label>
                        <input type="text" class="form-control" name="name" value='' required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('nid'); ?> &#42;</label>
                        <input type="text" class="form-control" name="nid" id="exampleInputEmail1" placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo lang('email'); ?> &#42;</label>
                        <input type="text" class="form-control" name="email" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo lang('password'); ?> &#42;</label>
                        <input type="password" class="form-control" name="password" placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo lang('address'); ?> &#42;</label>
                        <input type="text" class="form-control" name="address" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo lang('phone'); ?> &#42;</label>
                        <input type="text" class="form-control" name="phone" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Owner Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('edit_pet_owner'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editOwnerForm" class="clearfix" action="owner/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for=""> <?php echo lang('name'); ?> &#42;</label>
                        <input type="text" class="form-control" name="name" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('nid'); ?> &#42;</label>
                        <input type="text" class="form-control" name="nid" id="exampleInputEmail1" placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo lang('email'); ?> &#42;</label>
                        <input type="text" class="form-control" name="email" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" placeholder="********">

                    </div>
                    <div class="form-group">
                        <label for=""><?php echo lang('address'); ?> &#42;</label>
                        <input type="text" class="form-control" name="address" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo lang('phone'); ?> &#42;</label>
                        <input type="text" class="form-control" name="phone" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->


<!--Add Existing Owner-->
<!-- Add Owner Modal-->
<div class="modal fade" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_pet_owner'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="owner/joinowner" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for=""> <?php echo lang('name'); ?> &#42;</label>
                        <select name="joinowner_id" class="form-control select2" required>
                            <?php foreach ($allowners as $o) { ?>
                                <option value="<?php echo $o->id ?>"><?php echo $o->name.' (NID No: '.$o->nid .'- Phone: '.$o->phone .')'; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Owner Modal-->
<!--End add Existing Owner-->
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/owner.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>