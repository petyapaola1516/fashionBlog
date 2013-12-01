
<section>
<div class="formwrp2">
<div class="flower"></div>
<div class="contentwrp">

<form action="<?php echo $blog_form_action; ?>" method="post">
<input type="hidden" name="blog_content_id" value="<?php echo isset($blog_content_id) ? $blog_content_id : ''; ?>" />
<input type="hidden" name="form_token" value="<?php echo isset($form_token) ? $form_token : ''; ?>" />

	<p class="title">Добави тема</p>
	<p class="title2">Заглавие</p>
	<input class="name" type="text" name="blog_content_headline" value="<?php echo isset($blog_content_headline) ? $blog_content_headline : ''; ?>"/></dd>
		
	<p class="title2">Категория</p>
	<div class="name">
	<select name="blog_category_id">
	<?php
		foreach($categories as $id=>$cat)
		{
			echo "<option value=\"$id\"";
			/*** mark as selected ***/
			echo (isset($selected) && $id==$selected) ? ' selected' : '';
			echo ">$cat</option>\n";
		}
	?>
	</select>
	</div>
	<p class="title2">Съдържание</p>

	<textarea class="text_into" name="blog_content_text" rows="5" cols="45"><?php echo isset($blog_content_text) ? $blog_content_text : ''; ?></textarea>


	<a class="cancel_button">
		<input class="add" type="submit" value="<?php echo $blog_form_submit_value; ?>" />
		
	</a>
</form>
</div>

</section>

