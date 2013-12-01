<?php

	include 'includes/header.php';

	if(!isset($_GET['vc']))
	{
		$error = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Невалиден код</p></div></div></section>';
	}
	elseif(strlen($_GET['vc']) != 13)
	{
		$error = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Невалиден код</p></div></div></section>';
	}
	else
	{
		$blog_verification_code = mysql_real_escape_string($_GET['vc']);

		include 'includes/conn.php';

		if($db)
		{
			$sql = "UPDATE
				blog_users
				SET
				blog_user_status=1
				WHERE
				blog_user_status='{$blog_verification_code}'";

			$result = mysql_query($sql);

			if(mysql_affected_rows($link) != 1)
			{
				$message = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Не може да се валидира</p></div></div></section>';
			}
			else
			{
				$message = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Регистрацията е завършена.Моля влезнете с потребителско име и парола.</p></div></div></section>';
			}	
		}
	}
?>
<p><?php echo $message; ?></p>

<?php include 'includes/footer.php'; ?>
