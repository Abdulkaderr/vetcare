<!DOCTYPE html>
<html lang="en">

<head>
	<base href="<?php echo base_url(); ?>">
	<?php
	$settings = $this->frontend_model->getSettings();
	$title = explode(' ', $settings->title);
	$site_name = $this->db->get('website_settings')->row()->title;
	?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title><?php echo $site_name; ?></title>

	<!-- Favicons -->
	<link type="image/x-icon" href="petcare/assets/img/favicon.png" rel="icon">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="petcare/assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="petcare/assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="petcare/assets/plugins/fontawesome/css/all.min.css">

	<!-- Swiper CSS -->
	<link rel="stylesheet" href="petcare/assets/plugins/swiper/css/swiper.min.css">

	<!-- Animation CSS -->
	<link rel="stylesheet" href="petcare/assets/css/aos.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="petcare/assets/css/style.css">

	<link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css" />
	<link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">

</head>

<body>
	<style>
		.message {
			margin-top: 30px;
			margin-left: 171px;
			font-size: 21px;
			color: green;
		}

		/*new style for dropdown */
		

#nav li li a {
  color: #000;
  margin: 1rem;
}



/* highlights current hovered list item and the parent list items when hovering over sub menues */

#nav ul {
  position: absolute;
  padding: 0;
  left: 0;
  top: 50%;
  display: none;
  /* hides sublists */
}


#nav ul li a:hover {
	color: #09dca4;
}

/* hides sub-sublists */

#nav li:hover ul {
  display: block;
  opacity: 1;
  visibility: visible;
}

	</style>
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		<!-- Header -->
		<header class="header">
			<nav class="navbar navbar-expand-lg header-nav">
				<div class="navbar-header">
					<a id="mobile_btn" href="javascript:void(0);">
						<span class="bar-icon bar-icon-one">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</a>
					<a href="frontend#" class="navbar-brand logo">
						<img src="<?php echo $settings->logo; ?>" class="img-fluid" alt="Logo">
					</a>
				</div>
				<div class="main-menu-wrapper">
					<div class="menu-header ">
						<a href="frontend#" class="menu-logo">
							<img src="<?php echo $settings->logo; ?>" class="img-fluid" alt="Logo">
						</a>
						<a id="menu_close" class="menu-close" href="javascript:void(0);">
							<i class="fas fa-times"></i>
						</a>
					</div>
					<ul class="main-nav " id="nav">
						<li class="  ">
							<a href="frontend">Home <i class="fas fa-chevron"></i></a>

						</li>
						<li class="">
							<a href="frontend/doctors">Book Veterinarian </a>

						</li>
						<li class="">
							<a href="#">Lost/Found Pets</a>
							<ul>
								<li><a href="frontend/lostpets">Lost Pets</a></li>
								<li><a href="frontend/foundpets">Found Pets</a></li>
							
							</ul>
						</li>
						<!--<li class="">
							<a href="frontend/matingPet">Pet mating</a>

						</li>-->
						<li class="">
							<a href="home">My Pets </a>

						</li>

						<li class="">
							<a href="frontend/whoweare">Who we are </a>

						</li>

						<li class="">
							<a href="frontend/ourvision">Our vision </a>

						</li>

						<li class="">
							<a href="frontend/contactinfo">Contact info </a>

						</li>
						<?php
						$message = $this->session->flashdata('feedback');
						if (!empty($message)) {
						?>
							<li class="message"> <?php echo $message; ?></li>
						<?php } ?>



						<?php if ($this->ion_auth->logged_in() == '0') { ?>
							<li class="login-link">
								<a href="auth/login">Login / Signup</a>
							</li>
						<?php } else { ?>
							<li class="login-link">
								<a href="auth/logout">Logout</a>
							</li>
						<?php } ?>
					</ul>
				</div>
				<ul class="nav header-navbar-rht">
					<li class="nav-item contact-item">
						<div class="header-contact-img">
							<i class="far fa-hospital"></i>
						</div>
						<div class="header-contact-detail">
							<p class="contact-header">Contact</p>
							<p class="contact-info-header"> <?php echo $settings->phone; ?></p>
						</div>
					</li>
					<?php if (!$this->ion_auth->logged_in()) { ?>
						<li class="nav-item">
							<a class="nav-link header-login btn-one-light" href="frontend/ownerRegistration">Registration </a>
						</li>
						<li class="nav-item">
							<a class="nav-link header-login btn-one-light" href="auth/login" id="">Login </a>
						</li>
					<?php } else { ?>
						<li class="nav-item">
							<a class="nav-link header-login btn-one-light" href="auth/logout">Logout </a>
						</li>
					<?php } ?>
				</ul>
			</nav>
		</header>
		<!-- /Header -->
	</div>