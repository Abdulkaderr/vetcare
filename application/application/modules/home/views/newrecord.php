<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="common/js/google-loader.js"></script>
<section id="main-content">
    <section class="wrapper site-min-height">

    <div class="row" style="margin-top: 15rem;">
        <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
        <div class="col-md-3">
            <a href="prescription" class="btn green">
            <i class="fa fa-prescription"></i> <?php echo lang('add_pet_owner'); ?>
            </a>
        </div>
        <?php } ?>


        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) { ?>
        <div class="col-md-3">
            <a href="lab" class="btn green">
            <i class="fa fa-file-medical"></i> <?php echo lang('lab_reports'); ?>
            </a>
        </div>
        <?php } ?>

        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
        

        <div class="col-md-3">
            <a href="bed/bedAllotment" class="btn green">
            <i class="fa fa-bed"></i> <?php echo lang('bed_list'); ?>
            </a>
        </div>

        <div class="col-md-3">
            <a href="bed/bedCategory" class="btn green">
            <i class="fa fa-edit"></i> <?php echo lang('bed_category'); ?>
            </a>
        </div>


        <?php } ?>
    </div>
        

        <!--state overview end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<!--footer end-->
</section>
<?php
if (!empty($this_month['payment'])) {
    $payment_this = $this_month['payment'];
} else {
    $payment_this = '0';
}
if (!empty($this_month['expense'])) {
    $expense_this = $this_month['expense'];
} else {
    $expense_this = '0';
}

if (!empty($this_month['appointment_treated'])) {
    $appointment_treated= $this_month['appointment_treated'];
} else {
    $appointment_treated= '0';
}

        if (!empty($this_month['appointment_cancelled'])) {
            $appointment_cancelled= $this_month['appointment_cancelled'];
        } else {
            $appointment_cancelled= '0';
        }
       
?>
<script type="text/javascript">var payment_this = <?php echo $payment_this ?>;</script>
<script type="text/javascript">var expense_this = <?php echo $expense_this ?>;</script>
<script type="text/javascript">var appointment_treated = <?php echo $appointment_treated ?>;</script>
<script type="text/javascript">var appointment_cancelled = <?php echo $appointment_cancelled ?>;</script>
<script type="text/javascript">var per_month_income_expense = "<?php echo lang('per_month_income_expense') ?>";</script>
<script type="text/javascript">var currency = "<?php echo $settings->currency ?>";</script>
<script type="text/javascript">var months_lang = "<?php echo lang('months') ?>";</script>
<script type="text/javascript">var this_year = <?php echo json_encode($this_year['payment_per_month']); ?>;</script>
<script type="text/javascript">var this_year_expenses = <?php echo json_encode($this_year['expense_per_month']); ?>;</script>
<script src="common/extranal/js/home.js"></script>





