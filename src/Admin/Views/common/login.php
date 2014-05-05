<div class="well no-padding">
	<form action="/admin/login" id="login-form" class="smart-form client-form" method="post">
		<header>
			Sign In
		</header>

		<fieldset>
			
			<section>
				<label class="label">Username</label>
				<label class="input"> <i class="icon-append fa fa-user"></i>
					<input type="text" name="login-username">
					<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter your username</b></label>
			</section>

			<section>
				<label class="label">Password</label>
				<label class="input"> <i class="icon-append fa fa-lock"></i>
					<input type="password" name="login-password">
					<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
			</section>
            <?php /* ?>
			<section>
				<label class="checkbox">
					<input type="checkbox" name="remember" checked="">
					<i></i>Stay signed in</label>
			</section>
			*/ ?>
		</fieldset>
		<footer>
			<button type="submit" id="login-btn" class="btn btn-primary btn-block">Sign in <i class="fa fa-play-circle"></i></button>
		</footer>
	</form>
</div>