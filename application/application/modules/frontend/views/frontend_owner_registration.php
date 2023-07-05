<!-- Page Content -->
<style>
	.red {
		color: red;
	}
</style>
<div class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-8 offset-md-2">

				<!-- Login Tab Content -->
				<div class="account-content">
					<div class="row align-items-center justify-content-center">

						<div class="col-md-12 col-lg-6 login-right">
							<div class="login-header">
								<h3>Owner Registration <span></span></h3>
							</div>
							<form action="frontend/addNewOwner" method="post" enctype="multipart/form-data">
								<div class="form-group form-focus">
									<input type="text" name="name" class="form-control floating req"  required>
									<label class="focus-label">Name<span class="red"> *</span></label>
								</div>
								<div class="form-group form-focus">
									<input type="text" name="nid" class="form-control floating req" pattern="\d{10}" required title="Ten numbers" >
									<label class="focus-label">NID Number <span class="red"> *</span></label>
								</div>
								<div class="form-group form-focus">
									<input type="email" name="email" id='email' class="form-control floating req" required >
									<label class="focus-label">Email <span class="red"> *</span></label>
								</div>
								<div class="form-group form-focus">
									<input type="password" name="password" id="password" class="form-control floating req" required>
									<label class="focus-label">Password <span class="red"> *</span></label>
								</div>

								<div class="form-group form-focus">
									<input type="text" name="address" class="form-control floating req"  required>
									<label class="focus-label">Address <span class="red"> *</span></label>
								</div>
								<div class="form-group form-focus">
									<input type="text" name="phone" class="form-control floating req" pattern="\d{10}" required title="Ten numbers"  >
									<label class="focus-label">Phone +962xxxxxx <span class="red"> *</span></label>
								</div>
								<div class="form-group">
									<input type="file" name="img_url" class="form-control">
									<!-- <label class="focus-label">Profile Image</label> -->
								</div>
								<button class="btn btn-primary w-100 btn-lg login-btn" id="reg_btn"  >Submit</button>


							</form>
						</div>
					</div>
				</div>
				<!-- /Login Tab Content -->

			</div>
		</div>

	</div>

</div>
<!-- /Page Content -->

<script src="common/js/codearistos.min.js"></script>

<script>
	$(document).ready(function() {
		"use strict";
		$(".message").delay(3000).fadeOut(100);

		//$("form").submit(function(e){
			let error_check = false;
			//e.preventDefault(e);

			$("input.req").each(function(){
				$(this).keyup(function () {
					validateRequired($(this));
				});
			});

			function validateRequired(valreq){
				if(valreq.val().length == 0){
					error_check = true;
					valreq.after('<div class="red">This field is required</div>');
				} else {
					error_check = false;
					valreq.next('.red').remove();
				}
			}


			// Validate Email
			const email = document.getElementById("email");
			email.addEventListener("blur", () => {
				let regex =
				/^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
				let s = email.value;
				if (regex.test(s)) {
					//email.classList.remove("is-invalid");
					email.next('.red').remove();
					error_check = false;
				} else {
					//email.classList.add("is-invalid");
					$('#email').after("<div class='red'>Email is invalid</div>");
					error_check = true;
				}
			});
		
			// Validate Password
			$("#password").keyup(function () {
				validatePassword();
			});
			function validatePassword() {
				let passwordValue = $("#password").val();
				//alert(passwordValue.length);
				if (passwordValue.length < 3 || passwordValue.length > 10) {
					
					$("#password").after("<div class='red'>**length of your password must be between 3 and 10</div>");
					//$("#passcheck").css("color", "red");
					error_check = true;
					return false;
				} else {
					error_check = false;
					$(this).next('.red').remove()
				}
			}


			$("form").submit(function(e){
				if (error_check == false){
					//alert('done');
					$("form").submit();
				}
				else {
					e.preventDefault(e);
				}
			});
		//});
	});
</script>