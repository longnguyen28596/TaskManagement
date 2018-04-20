<?= $this->layout(false) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <?= $this->Html->css('login/vendor/bootstrap/css/bootstrap.min.css') ?>
<!--===============================================================================================-->
  <?= $this->Html->css('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>
<!--===============================================================================================-->
  <?= $this->Html->css('login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') ?>
<!--===============================================================================================-->
  <?= $this->Html->css('login/vendor/animate/animate.css') ?>
<!--===============================================================================================-->	
  <?= $this->Html->css('login/vendor/css-hamburgers/hamburgers.min.css') ?>
<!--===============================================================================================-->
  <?= $this->Html->css('login/vendor/animsition/css/animsition.min.css') ?>
<!--===============================================================================================-->
  <?= $this->Html->css('login/vendor/select2/select2.min.css') ?>
<!--===============================================================================================-->	
  <?= $this->Html->css('login/vendor/daterangepicker/daterangepicker.css') ?>
<!--===============================================================================================-->
  <?= $this->Html->css('login/util.css') ?>
  <?= $this->Html->css('login/main.css') ?>
  <?= $this->Html->css('login/custom_login.css') ?>

<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Yêu cầu reset mật khẩu
					</span>
				</div>

				<form class="login100-form validate-form" method="POST">
					<div class="wrap-input100 validate-input m-b-26" data-validate="email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Nhập email">
						<span class="focus-input100"></span>
					</div>
          <div class="message"><?= $this->Flash->render() ?></div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Reset mât khẩu
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
  <?= $this->Html->script('login/vendor/jquery/jquery-3.2.1.min.js') ?>
<!--===============================================================================================-->
  <?= $this->Html->script('login/vendor/animsition/js/animsition.min.js') ?>
<!--===============================================================================================-->
  <?= $this->Html->script('login/vendor/bootstrap/js/popper.js') ?>
  <?= $this->Html->script('login/vendor/bootstrap/js/bootstrap.min.js') ?>
<!--===============================================================================================-->
  <?= $this->Html->script('login/vendor/select2/select2.min.js') ?>
<!--===============================================================================================-->
  <?= $this->Html->script('login/vendor/daterangepicker/moment.min.js') ?>
  <?= $this->Html->script('login/vendor/daterangepicker/daterangepicker.js') ?>
<!--===============================================================================================-->
  <?= $this->Html->script('login/vendor/countdowntime/countdowntime.js') ?>
<!--===============================================================================================-->
  <?= $this->Html->script('login/main.js') ?>
</body>
</html>