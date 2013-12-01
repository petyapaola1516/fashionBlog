<?php
	error_reporting(E_ALL);

	include 'includes/header.php';

	include 'includes/conn.php';

	if($db)
	{
		$sql = "SELECT
			blog_content_headline,
			blog_content_text,
			DATE_FORMAT(blog_content_date, '%b %d %Y') AS blog_content_date,
			blog_category_name,
			blog_user_name
			FROM
			blog_content
			JOIN
			blog_users
			USING(blog_user_id)
			JOIN
			blog_categories
			USING(blog_category_id)
			ORDER BY blog_content_id DESC
			LIMIT 5";

		$result = mysql_query($sql) or die(mysql_error());

		$blog_array = array();

		if(is_resource($result))
		{
			if(mysql_num_rows($result) != 0)
			{
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					$blog_array[] = $row;
				}
			}
		}
		else
		{
			echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Темата е недостъпна</p></div></div></section>';
		}
	}
	else
	{
		echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Няма въведени теми</p></div></div></section>';
	}
?>
<div class="sectionWrp">
<section>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
   <div id="sliderFrame">
        <div id="slider">
                <img src="images/image-slider-2.jpg" alt="" />
                <img src="images/image-slider-3.jpg" />
            <img src="images/image-slider-4.jpg" />
                <img src="images/image-slider-5.jpg" />
            </a>
        </div>
    </div>
</section>
</div>


<?php

	if(sizeof($blog_array) > 0)
	{
		foreach($blog_array as $blog)
		{
			echo '<section>';
			echo '<div class="formwrp2">';
			echo '<div class="flower"></div>';
			echo '<div class="contentwrp">';
			echo '<p class="title2">Категория '.$blog['blog_category_name'].'<br> Публикувана от '.$blog['blog_user_name'].' на дата '.$blog['blog_content_date'].'</p>';
			echo '<p class="title">'.$blog['blog_content_headline'].'</p>';
			
			echo '<p class="content2">'.$blog['blog_content_text'].'</p>';
			echo '</div>';
			echo '</section>';
		}
	}
	else
	{
		echo '<section><div class="formwrp2"><div class="contentwrp"><p class="title">Няма теми</p></div></div></section>';
	}

	include 'includes/footer.php';

?>
