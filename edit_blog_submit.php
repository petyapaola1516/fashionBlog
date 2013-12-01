<?php
	ob_start();
	include 'includes/header.php';

	if(!isset($_SESSION['access_level'], $_SESSION['blog_user_id']))
	{
		header("Location: login.php");
		exit;
	}
	else
	{
		if(isset($_SESSION['form_token'], $_POST['blog_category_id'], $_POST['blog_content_id'], $_POST['blog_content_headline'], $_POST['blog_content_text']))
		{

			if(!is_numeric($_POST['blog_category_id']) || $_POST['blog_category_id']==0)
			{
				echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Името на категорията е невалидно</p></div></div></section>';
			}
			if(!is_numeric($_POST['blog_content_id']) || $_POST['blog_content_id']==0)
			{
				echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Невалидно ID</p></div></div></section>';
			}
			elseif(!is_string($_POST['blog_content_headline']) || strlen($_POST['blog_content_headline'])<3 || strlen($_POST['blog_content_headline'])>100)
			{
				echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Заглавието е навалидно</p></div></div></section>';
			}
			elseif(!is_string($_POST['blog_content_text']) || strlen($_POST['blog_content_text'])<3 || strlen($_POST['blog_content_text'])>10000)
			{
				echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Съдържанието е невалидно</p></div></div></section>';
			}
			else
			{	
				include 'includes/conn.php';

				if($db)
				{
				
					$blog_content_id = mysql_real_escape_string($_POST['blog_content_id']);
					$blog_category_id = mysql_real_escape_string($_POST['blog_category_id']);
					$blog_content_headline = mysql_real_escape_string($_POST['blog_content_headline']);
					$blog_content_text = mysql_real_escape_string($_POST['blog_content_text']);
	
					$sql = "UPDATE
						blog_content
						SET
						blog_category_id = {$blog_category_id},
						blog_content_headline = '{$blog_content_headline}',
						blog_content_text = '{$blog_content_text}'
						WHERE
						blog_content_id = $blog_content_id";

					
					if(mysql_query($sql))
					{
						unset($_SESSION['form_token']);

						echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Темата е променен успешно</p></div></div></section>';
					}
					else
					{
						echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Темата не може да се промени</p></div></div></section>';
					}
				}
				else
				{
					echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Не може да се свърже с формата</p></div></div></section>';
				}
			}
		}
		else
		{
			echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Невалиден запис</></div></div></section>';
		}
	}
		include 'includes/footer.php';
?>
