<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?php echo base_url(); ?>">
        <?php
	// $title = explode(' ', $settings->title);
	// $site_name = $this->db->get('website_settings')->row()->title;
	?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Rizvi">
        <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
        <link rel="shortcut icon" href="uploads/favicon.png">

        <title>Login - <?php echo $this->db->get('settings')->row()->system_vendor; ?></title>

        <!-- Bootstrap core CSS -->
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="common/css/style.css" rel="stylesheet">
        <link href="common/css/style-responsive.css" rel="stylesheet" />
        <link href="common/extranal/css/auth.css" rel="stylesheet">
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

<style>
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

    </head>

    <body class="login-body">
    <style>
		.message {
			margin-top: 30px;
			margin-left: 171px;
			font-size: 21px;
			color: green;
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
					<a href="frontend#" class="navbar-brand logo " style="margin-top: -20%;">
						<img src="<?php echo $settings->logo; ?>" class="img-fluid" alt="Logo">
					</a>
				</div>
				<div class="main-menu-wrapper">
					<div class="menu-header ">
						<a href="frontend#" class="menu-logo">
							<img src="<?php echo $settings->logo; ?>" style="margin-top: -20%f;" class="img-fluid" alt="Logo">
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
						<!--<li class="">
							<a href="frontend/missingPet">Missing Pets</a>

						</li>-->
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

        <div class="container">
            <form class="form-signin" method="post" action="auth/login">
                <h2 class="login form-signin-heading"><?php echo $this->db->get('settings')->row()->title; ?><br/><br/><img alt="" src="uploads/logo200.png"></h2>
                <div id="infoMessage"><?php echo $message; ?></div>
                <div class="login-wrap">
                    <input type="text" class="form-control" name="identity" placeholder="User Email" autofocus>
                    <input type="password" class="form-control"  name="password" placeholder="Password">
                   

<!-- <input type="hidden" name="redirect" value=""> -->
                    <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
					<a class="btn btn-lg  btn-block info" href="frontend/ownerRegistration">Sign up as Owner</a>

                </div>


				<p><a data-toggle="modal" href="#myModal"> Forgot Password?</a></p>
            </form>

        </div>









        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="auth/forgot_password">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>

                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <input class="btn detailsbutton" type="submit" name="submit" value="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="common/js/jquery.js"></script>
        <script src="common/js/bootstrap.min.js"></script>
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

    </body>
</html>
