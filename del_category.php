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
				echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Не може да се намери списък с категория</p></div></div></section>';
			}
			else
			{
				$categories = array();

				while($row = mysql_fetch_array($result))
				{
					$categories[$row['blog_category_id']] = $row['blog_category_name'];
				}
			}
		}
		else
		{
			echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Базата от  данни е несъществуваща</p></div></div></section>';
		}
	}
		
?>

<p>
<?php
	if(sizeof($categories == 0))
	{
		echo '';
	}
	else
	{
		echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Избери категория за изтриване</p></div></div></section>';
	}
?>
</p>
<section>
<form action="del_category_submit.php" method="post">
	<div class="flower"></div>
	<div class="contentwrp">
	
		<p class="title">Изтрий категория</p>
		<div class="name">
		<select name="blog_category_id">
		<?php
			foreach($categories as $id=>$cat)
			{
				echo "<option value=\"$id\">$cat</option>\n";
			}
		?>
		</select>
	</div>
	<a class="cancel_button">
		<input class="add" type="submit" value="Изтрий категория" onclick="return confirm('Сигурни ли сте?')"/>
	</a>
	</div>
</form>
</section>


<?php include 'includes/footer.php'; ?>
