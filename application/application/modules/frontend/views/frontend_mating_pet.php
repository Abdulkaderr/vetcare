
<body>
    <!-- Home Banner -->
    <div class="pharmacy-home-slider pharmacy-home-slider-primary">
        <div class="swiper-container">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <img src="petcare/assets/img/slidb1.jpg" alt="">
                </div>


            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="banner-wrapper">
                <div class="banner-header text-center " >
                    <h1>pet for mating</h1>
                </div>
                <!-- Search -->
                <div class="search-box " >
                    <form action="<?php echo base_url('frontend/matingPet') ?>" method="post">
                        <div class="form-group search-location">
                            <input type="text" class="form-control" placeholder="Search Location"
                            name="location_search2" id="location_search2">
                            <span class="form-text">Based on your Location</span>
                        </div>
                        <div class="form-group search-info">
                            <input type="text" class="form-control" placeholder="Search Dog, Cat, Etc"
                            name="name_search" id="name_search">
                            <span class="form-text">Type pet & owners</span>
                        </div>
                        <button type="submit" class="btn btn-primary search-btn mt-0"><i class="fas fa-search"></i> <span>Search</span></button>
                    </form><br>
                   <!-- <div class="col-6">	<a href="" class="btn btn-primary">Add pet for mating</a>  -->

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

        <div class="row">
    <?php foreach ($matingpets as $matingpet) { ?>
        <div class="col-md-4">
            <div class="profile-widget">
                <div class="doc-img">
                    <a href="patient-profile-mar.html">
                        <img class="img-fluid" alt="User Image" style="width: 370px;height: 246px;"
                        src="<?php if(!empty($matingpet->img_url)) { echo $matingpet->img_url;}else{ echo 'petcare/assets/img/b2.jpg';} ?>">
                    </a>
                    <a href="javascript:void(0)" class="fav-btn"> <i class="far fa-bookmark"></i>
                    </a>
                </div>
                <div class="pro-content">
                    <h3 class="title">
                        <i class="fas fa-check-circle verified"></i>
                        <a href="patient-profile-mar.html">Type pet: <?php echo $matingpet->pet_type; ?></a>
                        <i class="fas fa-check-circle verified"></i>
                    </h3>
                    <div class="rating">
                        <span class="d-inline-block average-rating"></span>
                    </div>
                    <ul class="available-info">
                        <li><i class="fas fa-map-marker-alt"></i>  <?php echo $this->patient_model->getPatientById($matingpet->patient)->address; ?></li>
                        <li> <?php echo $this->patient_model->getPatientById($matingpet->patient)->name; ?></li><br>
                        <li> <i class=""></i> <?php echo $matingpet->description; ?><i data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                        </li>
                    </ul>
                    <div class="row row-sm">
                        <div class="col-12"> <a href="https://api.whatsapp.com/send?phone=<?php echo $matingpet->phone; ?>" class="btn book-btn">Whatsapp</a></div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

            
        </div>
    </section>
<?php include("frontend_footer.php") ;?>

    <!-- /Popular Section -->