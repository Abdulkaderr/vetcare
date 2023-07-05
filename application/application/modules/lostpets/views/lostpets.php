<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <link href="common/extranal/css/owner.css" rel="stylesheet">
        <script src="common/js/codearistos.min.js"></script>
        <section class="panel">
            <header class="panel-heading">
                Lost Pets
                <!--<div class="clearfix no-print col-md-8 pull-right">
                    <div class="pull-right"></div>
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php //echo lang('add_pet_owner'); ?>
                            </button>
                        </div>
                    </a>

                </div>-->
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">

                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample11">
                        <thead>
                            <tr>
                                <th>Pet Number</th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('strain'); ?></th>
                                <th><?php echo lang('gender'); ?></th>
                                <th>Lost Date</th>
                                <th>Lost Location</th>
                                <th>Additional Comments</th>
                                <th>Approved?</th>
                                

                                <th class="no-print"><?php echo lang('options'); ?></th>
                                
                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($lostpets as $p) { ?>
                                <tr>
                                    <td><?php echo $p->pet_num; ?></td>
                                    <td><?php echo $p->pet_name; ?></td>
                                    <td><?php echo $p->pet_strain; ?></td>
                                    <td><?php echo $p->pet_gender; ?></td>
                                    <td><?php echo $p->lost_date; ?></td>
                                    <td><?php echo $p->lost_location; ?></td>
                                    <td><?php echo $p->comments; ?></td>
                                    <td><?php if ($p->approved == 0) { echo 'Not Approved'; } else { echo 'Approved'; } ?></td>
                                    <td>

                                    <?php if($this->ion_auth->in_group(array('admin'))){ 
                                        if ($p->approved == 0) { ?>
                                    <a class="btn btn-info btn-xs btn_width approve_button" title="Approve" href="lostpets/approve?id=<?php echo $p->id ?>"   onclick="javascript:return confirm('Are you sure you want to Approve this item?')"><i class="fa fa-check"> </i> Approve</a>
                                    <?php }
                                        else {?>
                                    <a class="btn btn-info btn-xs btn_width disapprove_button" title="Disapprove" href="lostpets/disapprove?id=<?php echo $p->id ?>"   onclick="javascript:return confirm('Are you sure you want to Disapprove this item?')"><i class="fa fa-times"> </i> Disapprove</a>
                                        <?php }
                                    } ?>

                                    <a class="btn btn-info btn-xs btn_width delete_button" title="Delete" href="lostpets/delete?id=<?php echo $p->id ?>"   onclick="javascript:return confirm('Are you sure you want to delete this item?')"><i class="fa fa-trash"> </i> Delete</a>
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





<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/owner.js"></script>
<script>
    $(document).ready(function () {
    "use strict";
  
    var table = $("#editable-sample11").DataTable({
      responsive: true,
  
      
    });
    table.buttons().container().appendTo(".custom_buttons");


  });
</script>