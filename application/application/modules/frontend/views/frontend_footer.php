<!-- Footer -->
<footer class="footer">
<?php $settings = $this->frontend_model->getSettings();?>			
				<!-- Footer Top -->
				<div class="footer-top aos" data-aos="fade-up">
					<div class="container-fluid">
						<div class="row">
							<!-- <div class="col-lg-3 col-md-6"> -->
							
								<!-- Footer Widget -->
								<!-- <div class="footer-widget footer-about">
									<div class="footer-logo">
										<a href="#" class="menu-logo">

										<img src="<?php //echo $settings->logo;?>" alt="logo">
									</div>
									<div class="footer-about-content">
										<div class="social-icon">
											<ul>
												<li>
													<a href="#" target="_blank"><i class="fab fa-facebook-f"></i> </a>
												</li>
												
												
											</ul>
										</div>
									</div>
								</div> -->
								<!-- /Footer Widget -->
								
							<!-- </div> -->
							
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								<div class="footer-widget footer-menu">
									<h2 class="footer-title">For Patients</h2>
									<ul>
										<li><a href="frontend/doctors">Search for Clinic</a></li>
									</ul>
								</div>
								<!-- /Footer Widget -->
								
							</div>
							
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								<div class="footer-widget footer-menu">
									<h2 class="footer-title">For pets</h2>
									<ul>
										<li><a href="frontend/missingPet">Missing Pets</a></li>
										<li><a href="frontend/matingPet">Pet mating</a></li>
									
									</ul>
								</div>
								<!-- /Footer Widget -->
								
							</div>
							
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								<div class="footer-widget footer-contact">
									<h2 class="footer-title">Contact Us</h2>
									<div class="footer-contact-info">
										<div class="footer-address">
											<span><i class="fas fa-map-marker-alt"></i></span>
											<p> <?php echo $settings->address; ?> </p>
										</div>
										<p>
											<i class="fas fa-phone-alt"></i>
											<?php echo $settings->phone; ?>
										</p>
										<p class="mb-0">
											<i class="fas fa-envelope"></i>
											<?php echo $settings->email; ?>
										</p>
									</div>
								</div>
								<!-- /Footer Widget -->
								
							</div>
							
						</div>
					</div>
				</div>
				<!-- /Footer Top -->
				
				<!-- Footer Bottom -->
                <div class="footer-bottom">
					<div class="container-fluid">
					
						<!-- Copyright -->
						<div class="copyright">
							<div class="row">
							<div class="footer-widget footer-contact">
									<h2 class="footer-title">Contact Us</h2>
									<div class="footer-contact-info">
										<div class="footer-address">
											<span><i class="fas fa-map-marker-alt"></i></span>
											<p> <?php echo $settings->address; ?> </p>
										</div>
										<p>
											<i class="fas fa-phone-alt"></i>
											<?php echo $settings->phone; ?>
										</p>
										<p class="mb-0">
											<i class="fas fa-envelope"></i>
											<?php echo $settings->email; ?>
										</p>
									</div>
								</div>
								<div class="col-md-6 col-lg-6">
									<div class="copyright-text">
										<p class="mb-0">&copy; 2022 TikApp. All rights reserved.</p>
									</div>
								</div>
								<div class="col-md-6 col-lg-6">
								
									<!-- Copyright Menu -->
									<div class="copyright-menu">
										<!-- <ul class="policy-menu">
											<li><a href="term-condition.html">Terms and Conditions</a></li>
											<li><a href="privacy-policy.html">Policy</a></li>
										</ul> -->
									</div>
									<!-- /Copyright Menu -->
									
								</div>
							</div>
						</div>
						<!-- /Copyright -->
						
					</div>
				</div>
				<!-- /Footer Bottom -->
				
			</footer>
			<!-- /Footer -->

			
	   </div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="petcare/assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="petcare/assets/js/bootstrap.bundle.min.js"></script>

		<!-- Swiper JS -->
		<script src="petcare/assets/plugins/swiper/js/swiper.min.js"></script>
		
		<!-- Slick JS -->
		<script src="petcare/assets/js/slick.js"></script>

		<!-- Animation JS -->
		<script src="petcare/assets/js/aos.js"></script>
		
		<!-- Custom JS -->
		<script src="petcare/assets/js/script.js"></script>


		<script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script>
	$(document).ready(function() {
		$(".default-date-picker").datepicker({
			format: "dd-mm-yyyy",
			autoclose: true,
			todayHighlight: true,
			startDate: "01-01-1900",
			clearBtn: true,
			language: 'en',
			});
	});
</script>		
	</body>
</html>

