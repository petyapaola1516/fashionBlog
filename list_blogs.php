<?php
	ob_start();

	include 'includes/header.php';


	if(!isset($_SESSION['access_level']))
	{
		header("Location: login.php");
		exit;
	}
	else
	{
		include 'includes/conn.php';

		if($db)
		{
			$sql = "SELECT
				blog_content_id,
				blog_content_headline
				FROM
				blog_content
				";

			if($_SESSION['access_level'] == 1)
			{
				$blog_user_id = mysql_real_escape_string($_SESSION['blog_user_id']);
				$sql .= " WHERE blog_user_id = $blog_user_id";
			}
		
			$result = mysql_query($sql) or die(mysql_error());

			if(is_resource($result))
			{
				if(mysql_num_rows($result) != 0)
				{
					$blog_array = array();
					while($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{
						$blog_array[] = $row;
					}
				}
				else
				{
					echo 'No Blog Entries Found';
				}
			}
			else
			{
				echo 'Blog Unavailable';
			}
		}
		else
		{
			echo 'No Blog Entries Available';
		}
	}
?>

<section>
<div class="formwrp2">
<div class="flower"></div>
<div class="contentwrp">

<?php

	foreach($blog_array as $blog)
	{
		echo '
		<div class="white"><div class="name"><p class="title">'.$blog['blog_content_id'].'
		'.$blog['blog_content_headline'].'</p></div>
		<div class="name"><a class="cancel_button" href="edit_blog.php?bid='.$blog['blog_content_id'].'">Редактирай</a></div>
		<div class="name"><a class="cancel_button" href="delete_blog.php?bid='.$blog['blog_content_id'].'" onclick="return confirm(\'Сигурни ли сте?\')">Изтрий</a></div></div>
		';
	}
?>

</div>

</section>



<?php
	include 'includes/footer.php';
?>
