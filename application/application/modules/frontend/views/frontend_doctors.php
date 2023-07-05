
            <body>
			<!-- Home Banner -->
			<div class="pharmacy-home-slider pharmacy-home-slider-primary">
				<div class="swiper-container">
				    <div class="swiper-wrapper">
				      	<div class="swiper-slide">
				      		<img src="petcare/assets/img/slide2.jpg" alt="">
				      	</div>
				      	<div class="swiper-slide">
					      	<img src="petcare/assets/img/slide1.jpg" alt="">
				      	</div>
				    </div>
				    <!-- Add Arrows -->
				    <div class="swiper-button-next"></div>
				    <div class="swiper-button-prev"></div>
				    <div class="banner-wrapper">
						<div class="banner-header text-center " >
							<h1>Search for a vet's using the region or the  name.</h1>
						</div>
						<!-- Search -->
						<div class="search-box " >
							<form action="<?php echo base_url('frontend/doctors'); ?>" method="post"> 
								<div class="form-group search-location">
									<input type="text" class="form-control" placeholder="Search Location" 
									name="location_search" id="location_search">
									<!-- <span class="form-text">Based on your Location</span> -->
								</div>
								<div class="form-group search-info">
									<input type="text" class="form-control" placeholder="Search Doctors, Clinics, Etc"
									name="doctor_search" id="doctor_search">
									<!-- <span class="form-text">vet's name</span> -->
								</div>
								<button type="submit" name="submit" id="submit"
								 class="btn btn-primary search-btn mt-0"><i class="fas fa-search"></i> <span>Search</span></button>
							</form>
						</div>
						<!-- /Search -->
					</div>
				</div>
				<!-- Add Pagination -->
				<div class="swiper-pagination"></div>
			</div>
			<!-- /Home Banner -->



			 		<!-- Popular Section -->
		<section class="section section-doctor">
			<div class="container-fluid">
				<div class="section-header text-center aos" data-aos="fade-up">
					<h2>Book Our Best Doctor</h2>
				</div>
				
				<div class="row">
  <?php foreach ($doctors as $doctor) { ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <div class="profile-widget">
        <div class="doc-img">
          <a href="doctor-profile.html">
            <img class="img-fluid" alt="User Image" style="width: 370px;height: 246px;"
			 src="<?php echo $doctor->img_url; ?>">
          </a>
          <a href="javascript:void(0)" class="fav-btn">
            <i class="far fa-bookmark"></i>
          </a>
        </div>
        <div class="pro-content">
          <h3 class="title">
            <a href="doctor-profile.html"><?php echo $doctor->name; ?></a>
            <i class="fas fa-check-circle verified"></i>
          </h3>
          <div class="rating">
            <span class="d-inline-block average-rating"></span>
          </div>
          <ul class="available-info">
            <li><i class="fas fa-map-marker-alt"></i> <?php echo $doctor->address; ?></li>
            <li><?php echo $this->department_model->getDepartmentById($doctor->department)->name; ?></li>
            <li><i class=""></i> <?php echo $doctor->profile; ?> <i data-bs-toggle="tooltip" title="Lorem Ipsum"></i></li>
          </ul>
          <div class="row row-sm">
            <div class="col-6">
              <a href="frontend/doctorDetails?id=<?php echo $doctor->id; ?>" class="btn view-btn">View Profile</a>
            </div>
            <div class="col-6">
              <a href="frontend/doctorBooking?id=<?php echo $doctor->id; ?>" class="btn book-btn">Book Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

			
			</div>
		</section>

		
		<!-- /Popular Section -->






			

			
		

