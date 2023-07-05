<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
         <link href="common/extranal/css/bed/bed.css" rel="stylesheet">
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('bed_categories'); ?>  
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('category'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                    

                        <?php foreach ($categories as $category) { ?>
                            <tr class="">
                                <td><?php echo $category->category; ?></td>
                                <td> <?php echo $category->description; ?></td>
                                <td class="no-print">
                                    <button type="button" title="<?php echo lang('edit'); ?>" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $category->id; ?>"> Edit <i class="fa fa-edit"></i> </button>   
                                    <!-- <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="bed/deleteBedCategory/delete?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a> -->
                                </td>
                            </tr>
                        <?php } ?>

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
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_bed_category'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="bed/addCategory" class="clearfix row" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12"> 
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?> &#42;</label>
                        <input type="text" class="form-control" name="category"  value='' placeholder="" required="">    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &#42;</label>
                        <input type="text" class="form-control" name="description"  value='' placeholder="" required="">
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
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('edit_bed_category'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editBedCategoryForm" class="clearfix row" action="bed/addCategory" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12"> 
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?> &#42;</label>
                        <input type="text" class="form-control" name="category"  value='' placeholder="" required="">    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &#42;</label>
                        <input type="text" class="form-control" name="description"  value='' placeholder="" required="">
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

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/bed/bed_category.js"></script>
