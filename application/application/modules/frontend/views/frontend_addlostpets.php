<style>
	.green {
		background: green;
		color: #fff;
		margin-bottom: 30%;
	}
	.red {
		color: red;
	}
</style>
<body>
	<!-- Home Banner -->
	<div class="pharmacy-home-slider pharmacy-home-slider-primary">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<img src="petcare/assets/img/slidb2.jpg" alt="">
				</div>


				<div class="swiper-slide">
					<img src="petcare/assets/img/slidb3.jpg" alt="">
				</div>
			</div>
			<!-- Add Arrows -->
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			<div class="banner-wrapper">
				<div class="banner-header text-center " >
					<h1>Find your lost pet or add if you found </h1>
				</div>
				<!-- Search -->
				<!-- <div class="search-box " >
					<form action="<?php echo base_url('frontend/missingPet') ?>" method="post">
						<div class="form-group search-location">
							<input type="text" class="form-control" placeholder="Search Location"
							name="location_search" id="location_search">
							<span class="form-text">Based on your Location</span>
						</div>
						<div class="form-group search-info">
							<input type="text" class="form-control" placeholder="Search Cat, Dog, Etc"
							name="name_search" id="name_search">
							<span class="form-text">pets Type & owners</span>
						</div>
						<button type="submit" class="btn btn-primary search-btn mt-0"><i class="fas fa-search"></i> <span>Search</span></button>

					</form><br> -->
					<!-- <div class="col-6"> <a href="" class="btn btn-primary">Add pet</a> -->



					</div>
					
				</div>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
		</div>
		<!-- /Home Banner -->



		<!-- *****************************************************************
****************************************************
****************************
*************************
**********************
****************************-->



































		<!-- *******************
************************
***********************
****************** -->




		<!-- Popular Section -->
		<section class="section section-doctor">
			<div class="container-fluid">
				<div class="section-header text-center">
					<h2>Add lost pet information</h2>
				</div>


						
				<div class="row">
				
				
				<form role="form" action="frontend/postaddlostpet" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for=""> Pet No. :</label>
						<select name="pet_num" class="form-control">
							<?php foreach ($pets as $p) { ?>
							<option value="<?php echo $p->patient_number; ?>"> <?php echo $p->patient_number .' | ' . $p->name; ?></option>
							<?php } ?>
						</select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Pet Name:</label>
                        <input type="text" class="form-control" name="pet_name" id="exampleInputEmail1" placeholder="">
                    </div>

					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('image'); ?> <span class="red">*</span></label>
						<input type="file" name="pet_img" required>
					</div>
					
                    <div class="form-group">
                        <label for=""><?php echo lang('strain'); ?> <span class="red">*</span></label>
                        <input type="text" class="form-control" name="pet_strain" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo lang('gender'); ?> <span class="red">*</span></label>
						<select name="pet_gender" class="form-control" required>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
  						</select>
                    </div>

					<div class="form-group">
                        <label>When did you lost the pet? <span class="red">*</span></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="lost_date" placeholder="" required="" >
                    </div>
                    <div class="form-group">
                        <label for="">Where did you lost the pet? <span class="red">*</span></label>
                        <input type="text" class="form-control" name="lost_location" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="">Additional Comments</label>
						<textarea name="comments" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>
</div>




								
					</div>
				</div>
			
			</div>
		</section>

		

		<!-- /Popular Section -->

		