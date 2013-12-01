

<h2><?php echo isset($heading) ? $heading : ''; ?></h2>
<section>
<form action="<?php echo isset($form_action) ? $form_action : ''; ?>" method="post">
	<div class="flower"></div>
	<div class="contentwrp">
		<p class="title">Регистрация</p>
		<label for="blog_user_name">Потребител</label>
		<input class="name" type="text" id="blog_user_name" name="blog_user_name" value="<?php echo isset($blog_user_name) ? $blog_username : ''; ?>" maxlength="20" />
		
		<label for="blog_password">Парола</label>
		<input class="email" type="password" id="blog_user_password" name="blog_user_password" value="" maxlength="20" />
		
		<label for="blog_password2">Потвърди парола </label>
		<input class="email" type="password" id="blog_user_password2" name="blog_user_password2" value="" maxlength="20"/>
		
		<label for="blog_user_email">Емайл</label>
		<input class="email" type="text" id="blog_user_email" name="blog_user_email" value="<?php echo isset($blog_user_email) ? $blog_user_email : ''; ?>" maxlength="254" />
		
		
		<input type="hidden" name="form_token" value="<?php echo isset($form_token) ? $form_token : ''; ?>" />
		<a class="cancel_button">
			<input class="add" type="submit" value="<?php echo isset($submit_value) ? $submit_value : 'Submit'; ?>" />
		</a>
		
	</div>

</form>
</section>