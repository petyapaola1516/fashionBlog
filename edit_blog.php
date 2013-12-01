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
		$form_token = uniqid();
		$_SESSION['form_token'] = $form_token;

		if(isset($_GET['bid']) && is_numeric($_GET['bid']))
		{
			include 'includes/conn.php';

			if($db)
			{
				$categories = array();
				$sql = "SELECT blog_category_id, blog_category_name FROM blog_categories";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
					$categories[$row['blog_category_id']] = $row['blog_category_name'];
				}

				$blog_content_id = mysql_real_escape_string($_GET['bid']);
				$sql = "SELECT
					blog_content_id,
					blog_content_headline,
					blog_content_text,
					blog_category_id,
					blog_category_name
					FROM
					blog_content
					JOIN
					blog_categories
					USING(blog_category_id)
					WHERE
					blog_content_id = $blog_content_id";

				if($_SESSION['access_level'] == 1)
				{

					$blog_user_id = mysql_real_escape_string($_SESSION['blog_user_id']);
					$sql .= " AND blog_user_id=$blog_user_id";
}
				$result = mysql_query($sql) or die(mysql_error());

				if(!is_resource($result))
				{
					echo 'Unable to fetch blog record';
				}
				else
				{
					
					if(mysql_num_rows($result) != 0)
					{
						while($row = mysql_fetch_array($result))
						{
							$heading = 'Edit Blog';	
							$blog_form_action = 'edit_blog_submit.php';
							$selected = $row['blog_category_id'];
							$blog_content_id = $row['blog_content_id'];
							$blog_content_headline = $row['blog_content_headline'];
							$blog_content_text = $row['blog_content_text'];
							$blog_form_submit_value = 'Редактирай темата';
						}
						
						include 'includes/blog_form.php';
					}
					else
					{
						echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Няма намерена тема</p></div></div></section>';
					}
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
