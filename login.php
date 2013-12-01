<?php
	session_start();

	include 'includes/header.php'; 

	$_SESSION['form_token'] = md5(rand(time(), true));
?>
<section>
<form action="login_submit.php" method="post">
	<div class="flower"></div>
	<div class="contentwrp">
	<input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>" />
		<p class="title">Вход</p>
		<p class="title2">Потребител</p>
		<input class="name" type="text" name="blog_user_name"  />
		
		<p class="title2">Парола</p>
		<input class="email" type="password" name="blog_user_password" />
		
		<a class="cancel_button">
			<input class="add" type="submit" value="Вход" />
		</a>
		
	</div>

</form>
</section>
<?php include 'includes/footer.php'; ?>