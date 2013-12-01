<?php

	ob_start();

	include 'includes/header.php';

	if(!isset($_SESSION['access_level']) || $_SESSION['access_level'] < 1)
	{
		header("Location: login.php");
		exit;
	}
	else
	{
		$form_token = uniqid();
		$_SESSION['form_token'] = $form_token;

		include 'includes/conn.php';
		if($db)
		{
			$sql = "SELECT
				blog_category_id,
				blog_category_name
				FROM
				blog_categories";
			$result = mysql_query($sql);
			if(!is_resource($result))
			{
				echo 'Unable to find any categories';
			}
			else
			{

				if(mysql_num_rows($result) != 0)
				{
					$categories = array();
					while($row = mysql_fetch_array($result))
					{	
						$categories[$row['blog_category_id']] = $row['blog_category_name'];
					}
					$blog_form_action = 'add_blog_submit.php';
					$blog_heading = "Добави съдържание";
					$blog_content_headline = '';
					$blog_content_text = '';
					$blog_form_submit_value = 'Добави тема';

					include 'includes/blog_form.php';
				}
				else
				{
					echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Няма намерени категории</p></div></div></section>';
				}
			}
		}
		else
		{
			echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Не може да изпълни заявката</p></div></div></section>';
		}

		include 'includes/footer.php';
	}
?>
