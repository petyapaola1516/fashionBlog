<?php
error_reporting(E_ALL);

session_start();


include 'includes/header.php'; 


$errors = array();


if(!isset($_SESSION['form_token']))
{
	$errors[] = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Невалидна форма</p></div></div></section>';
}

elseif(!isset($_POST['form_token'], $_POST['blog_user_name'], $_POST['blog_user_password'], $_POST['blog_user_password2'], $_POST['blog_user_email']))
{
	$errors[] = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Всички полета трябва да са попълнени</p></div></div></section>';
}

elseif($_SESSION['form_token'] != $_POST['form_token'])
{
	$errors[] = '<section><div class="formwrp2"><div class="contentwrp"><p class="title"></p></div></div></section>';
}

elseif(strlen($_POST['blog_user_name']) < 2 || strlen($_POST['blog_user_name']) > 25)
{
	$errors[] = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Невалидно потребителско име</p></div></div></section>';
}

elseif(strlen($_POST['blog_user_password']) <= 4 || strlen($_POST['blog_user_password']) > 25)
{
	$errors[] = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Невалидна парола</p></div></div></section>';
}
elseif(strlen($_POST['blog_user_email']) < 4 || strlen($_POST['blog_user_email']) > 254)
{
	$errors[] = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Невалиден емайл</p></div></div></section>';
}

elseif(!preg_match("/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU", $_POST['blog_user_email']))
{
	$errors[] = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Невалиден емайл</p></div></div></section>';
}
else
{

	$blog_user_name = mysql_real_escape_string($_POST['blog_user_name']);
	
	$blog_user_password = sha1($_POST['blog_user_password']);
	$blog_user_password = mysql_real_escape_string($blog_user_password);
	
	$blog_user_email =  preg_replace( '((?:\n|\r|\t|%0A|%0D|%08|%09)+)i' , '', $_POST['blog_user_email'] );
	$blog_user_email = mysql_real_escape_string($blog_user_email);

	include 'includes/conn.php';

	if($db)
	{
		$sql = "SELECT
			blog_user_name,
			blog_user_email
			FROM
			blog_users
			WHERE
			blog_user_name = '{$blog_user_name}'
			OR
			blog_user_email = '{$blog_user_email}'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		if($row[0] == $blog_user_name)
		{
			$errors[] = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Потребителското име вече съществува</p></div></div></section>';
		}
		elseif($row[1] == $blog_user_email)
		{
			$errors[] = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Емайла вече съществува</p></div></div></section>';
		}
		else
		{

		
			$verification_code = uniqid();

			$sql = "INSERT
				INTO
				blog_users(
				blog_user_name,
				blog_user_password,
				blog_user_email,
				blog_user_access_level,
				blog_user_status)
				VALUES (
				'{$blog_user_name}',
				'{$blog_user_password}',
				'{$blog_user_email}',
				1,
				'{$verification_code}')";
	
				
				
			if(mysql_query($sql))
			{
				unset($_SESSION['token']);

				$path = dirname($_SERVER['REQUEST_URI']);
				$link = 'http://'.$_SERVER['HTTP_HOST'].$path.'/verify.php?vc='.$verification_code;
				
				$zaglavie = '<section><div class="formwrp2"><div class="contentwrp"><p class="title">За да завършите регистрацията моля кликнете ';
				
				
				echo $zaglavie;
				echo '<a href="'.$link.'">тук</a></p></div></div></section>';
	
			}
}
}
}			
				


include 'includes/footer.php';

?>
