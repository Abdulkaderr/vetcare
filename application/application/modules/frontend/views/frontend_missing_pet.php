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
				<div class="section-header text-center aos" data-aos="fade-up">
					<h2>Find your lost pet</h2>
				</div>
				<div class="row">
  <?php foreach ($missingpets as $missingpet) { ?>
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="profile-widget">
        <div class="doc-img">
          <a href="">
            <img class="img-fluid" alt="User Image" style="width: 370px;height: 246px;"
			 src="<?php if(!empty($missingpet->img_url)) { echo $missingpet->img_url;}else{ echo 'petcare/assets/img/b2.jpg';} ?>">
          </a>
          <a href="javascript:void(0)" class="fav-btn"> <i class="far fa-bookmark"></i>
          </a>
        </div>
        <div class="pro-content">
          <h3 class="title">
            <a href="">Type pet: <?php echo $missingpet->pet_type; ?></a>
            <i class="fas fa-check-circle verified"></i>
          </h3>
          <div class="rating">
            <span class="d-inline-block average-rating"></span>
          </div>
          <ul class="available-info">
            <li><i class="fas fa-map-marker-alt"></i>  <?php echo $this->patient_model->getPatientById($missingpet->patient)->address; ?></li>
            <li>  <?php echo $this->patient_model->getPatientById($missingpet->patient)->name; ?></li><br>
            <li> <i class=""></i> <?php echo $missingpet->description; ?><i data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
            </li>
          </ul>
          <div class="row row-sm">
            <div class="col-6"> <a href="https://api.whatsapp.com/send?phone=<?php echo $missingpet->phone; ?>" class="btn book-btn">Whatsapp</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>




								
					</div>
				</div>
			
			</div>
		</section>


		<!-- /Popular Section -->