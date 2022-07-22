<?php
session_start();


if (isset($_SESSION['user'])) {
	# code...
	header('Location:./demo.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>School Managemeny System</title>
	<link href="https://play-lh.googleusercontent.com/INY4vfQNUb6DmvSAmEDqcZAJzYbDkPa9WORf0AdZMeJQDBXkPeQypC-25Cl1Rc1XLzA" type="image/png" rel="icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="./asset/css/style.css">
	<link rel="stylesheet" href="./asset/css/multistep.css">
	<style>
		.overlay {
			display: none;
			position: fixed;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			z-index: 999;
			background: rgba(255, 255, 255, 0.8) url("./images/loader.gif") center no-repeat;
		}

		/* Turn off scrollbar when body element has the loading class */
		body.loading {
			overflow: hidden;
		}

		/* Make spinner image visible when body element has the loading class */
		body.loading .overlay {
			display: block;
		}
	</style>
</head>

<body>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<div id="container" class="box">
		<!-- FORM SECTION -->
		<div class="row">
			<div class="overlay"></div>
			<!-- SIGN UP -->
			<div class="col align-items-center flex-col sign-up">

				<div class="form-wrapper align-items-center" id="regis">

					<form id="myForm" action="" method="post" enctype="multipart/form-data">

						<div id="step" style="margin-top:10px; margin-bottom:10px">
							<span class="step"></span>
							<span class="step"></span>
							<span class="step"></span>
						</div>

						<!-- First tab -->

						<div class="form sign-up tab">
							<div class="alert alert-info text-center">School Registration Details:</div>
							<div class="input-group">
								<i class='bx bxs-user'></i>
								<input type="text" name="sname" id="sname" placeholder="School Name" oninput="this.className = ''">
							</div>
							<div class="input-group">
								<i class='bx bxs-user'></i>
								<input type="text" name="saddress" id="saddress" placeholder="Address" oninput="this.className = ''">
							</div>
							<div class="input-group">
								<i class='bx bx-mail-send'></i>
								<input type="email" name="semail" id="semail" placeholder="Email" require>
							</div>
							<div class="input-group">
								<i class='bx bxs-lock-alt'></i>
								<input type="number" name="scontact" id="scontact" placeholder="Contact No." oninput="this.className = ''">
							</div>
						</div>

						<!-- second tab -->
						<div class="form sign-up tab">
							<div class="alert alert-info text-center">Admin Personal Details:</div>
							<div class="input-group">
								<i class='bx bxs-name'></i>
								<input type="text" name="aname" id="aname" placeholder="Name" oninput="this.className = ''">
							</div>
							<div class="input-group">
								<i class='bx bx-mail-send'></i>
								<input type="email" name="aemail" id="aemail" placeholder="Email" require>
							</div>
							<div class="input-group">
								<i class='bx bxs-lock-alt'></i>
								<input type="number" name="amobile" id="amobile" placeholder="Mobile No." oninput="this.className = ''">
							</div>
							<div class="input-group">
								<i class='bx bxs-lock-alt'></i>
								<input type="date" name="adob" id="adob" placeholder="Date of Birth" oninput="this.className = ''">
							</div>
							<div class="input-group d-flex justify-content-center align-item-center">
								<i class="bx bxs-name"></i>
								<div class="gen ms-4 me-4"><input type="radio" value="Male" name="agender" id="male" oninput="this.className = ''">Male</div>
								<div class="gen ms-4 me-4"><input type="radio" value="Female" name="agender" id="female" oninput="this.className = ''">Female</div>
							</div>
							<div class="input-group">
								<i class='bx bxs-name'></i>
								<input type="text" name="aquali" id="aquali" placeholder="Qualification" oninput="this.className = ''">
							</div>


						</div>

						<!-- third tab -->
						<div class="form sign-up tab">

							<div class="alert alert-info text-center">Admin Signup Details:</div>
							<div class="input-group">
								<i class='bx bxs-user'></i>
								<input type="text" name="ausername" id="ausername" placeholder="Username" oninput="this.className = ''">
							</div>
							<div class="input-group">
								<i class='bx bxs-lock-alt'></i>
								<input type="password" name="apass" id="apass" placeholder="Password" oninput="this.className = ''">
							</div>
							<div class="input-group">
								<i class='bx bxs-lock-alt'></i>
								<input type="password" name="acpass" id="acpass" placeholder="Confirm password" oninput="this.className = ''">
							</div>
						</div>



						<div style="margin-top: 20px; display: flex; justify-content:center;">
							<div><button class="btn btn-secondary " type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button></div>
							<div><button class="btn d-none btn-success ms-3" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button></div>
						</div>
					</form>
				</div>
			</div>

			<!-- END SIGN UP -->

			<!-- SIGN IN -->
			<div class="col align-items-center flex-col sign-in">
				<?php
				if (isset($_GET['msg'])) {
				?>
					<div id="jil" class='alert alert-primary text-center'> <?= $_GET['msg']; ?> </div>
					<script>
						setTimeout(function() {
							document.getElementById('jil').style.display = 'none';
						}, 3000)
					</script>
				<?php

				}

				?>


				<div id="login-msg" class="alert alert-danger text-center d-none"></div>

				<div class="form-wrapper align-items-center">
					<div class="form sign-in">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<select class="form-select" id="role" name="role" required aria-label="Default select example">
								<option selected disabled>Select role</option>
								<option value="admin">Admin</option>
								<option value="teacher">Teacher</option>
								<option value="student">Student</option>
								<option value="parent">Parent</option>
							</select>
						</div>
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="email" placeholder="Username" id="l_email" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" placeholder="Password" id="l_pass" required>
						</div>
						<button id="checkLogin">
							Sign in
						</button>
						<div id="spinner" class="mt-3 d-none">
							<div class="spinner-grow text-primary" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
							<div class="spinner-grow text-secondary" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
							<div class="spinner-grow text-success" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
							<div class="spinner-grow text-danger" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
							<div class="spinner-grow text-warning" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
							<div class="spinner-grow text-info" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>
						<p style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
							<b>
								Forgot password?
							</b>
						</p>
						<p>
							<span>
								Don't have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign up here
							</b>
						</p>
					</div>
				</div>
			</div>
			<!-- END SIGN IN -->
		</div>
		<!-- END FORM SECTION -->
		<!-- CONTENT SECTION -->
		<div class="row content-row">
			<!-- SIGN IN CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						Welcome
					</h2>

				</div>
				<div class="img sign-in">

				</div>
			</div>
			<!-- END SIGN IN CONTENT -->
			<!-- SIGN UP CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="img sign-up">

				</div>
				<div class="text sign-up">
					<h2>
						Join with us
					</h2>

				</div>
			</div>
			<!-- END SIGN UP CONTENT -->
		</div>
		<!-- END CONTENT SECTION -->
	</div>


	<!-- Modal -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Forgot Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div id="fpass" class="alert alert-danger d-none"></div>
					<div class="input-group">
						<i class='bx bxs-user'></i>
						<input type="email" placeholder="Email ID." id="f-email" required>
					</div>
					<div class="input-group d-flex justify-content-center">
						<div><button type="button" id="sendMail" class="btn btn-success">Reset Password</button></div>
					</div>

					<div id="fspinner" class="mt-3 text-center d-none">
						<div class="spinner-grow text-primary" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
						<div class="spinner-grow text-secondary" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
						<div class="spinner-grow text-success" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
						<div class="spinner-grow text-danger" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
						<div class="spinner-grow text-warning" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
						<div class="spinner-grow text-info" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- script links -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

	<script src="./asset/js/index.js"></script>

	<script>
		// forgot pass

		$('#f-email').on('keyup', function() {

			var value = $('#f-email').val();
			if (value.length == 0) {
				$('#f-email').css({
					"border": "2px solid red"
				});
			} else {
				$('#f-email').css({
					"border": "2px solid blue"
				});
			}
		});
		$('#sendMail').on('click', function() {


			if ($('#f-email').val() == "") {
				$('#f-email').css({
					"border": "2px solid red"
				});
			} else {
				$('#f-email').css({
					"border": "2px solid blue"
				});

				$.ajax({
					method: 'POST',
					url: './admin/actions/forgot-pass.php',
					data: {
						femail: $('#f-email').val()
					},
					beforeSend: function() {
						$('#fspinner').removeClass('d-none');
					},
					complete: function() {

						$('#fspinner').addClass('d-none');
					},
					success: function(res) {

						$('#fpass').removeClass('d-none');
						$('#fpass').html(res);

						setTimeout(function() {
							$('#fpass').addClass('d-none');
						}, 5000)

					}
				})
			}
		})
	</script>
</body>

</html>