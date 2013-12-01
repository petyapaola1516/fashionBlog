<?php

error_reporting(E_ALL);

	ob_start();

	include 'includes/header.php';

	if(!isset($_SESSION['access_level']) || $_SESSION['access_level'] != 5)
	{
		header("Location: index.php");
		exit;
	}
	else
	{

		if (empty($_SESSION['token']))
		{
		   $_SESSION['token'] = md5(session_id() . time());
		}
	
		if(isset($_SESSION['token'], $_POST['blog_category_id']) && is_numeric($_POST['blog_category_id']))
		{

			include 'includes/conn.php';
			if($db)
			{
				
				$blog_category_id = mysql_real_escape_string($_POST['blog_category_id']);

				$sql = "DELETE FROM blog_categories WHERE blog_category_id = $blog_category_id";

				if(mysql_query($sql))
				{
					unset($_SESSION['token']);

					$affected = mysql_affected_rows($link);

					echo "$affected";
					echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Категорията е изтрита</p></div></div></section>';
				}
				else
				{
					echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Категорията не е изтрита</p></div></div></section>';
				}
			}
			else
			{
				echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Не може да се свърже с формата</p></div></div></section>';
			}
		}
		else
		{
			echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Невалиден запис</></div></div></section>';
		}
	}
	include 'includes/footer.php';
?>
