<?php

	ob_start();

	include 'includes/header.php';

	if(!isset($_SESSION['access_level']) || $_SESSION['access_level'] != 5)
	{
		header("Location: index.php");
		exit;
	}
	else
	{
		$form_token = uniqid();
		$_SESSION['form_token'] = $form_token;
	}
?>

<section>
<form action="add_category_submit.php" method="post">
	<div class="flower"></div>
	<div class="contentwrp">
	<p class="title">Добави категория</p>
	<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
	<input class="name" type="text" name="blog_category_name" />
	<a class="cancel_button">
		<input class="add" type="submit" value="Добави категория" />
	</a>
	</div>
</form>
</section>

<?php
	include 'includes/footer.php';
	ob_end_flush();
?>
