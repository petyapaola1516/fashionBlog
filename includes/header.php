<?php
	/*** begin session ***/
	
	
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


	if(isset($_SESSION['access_level']))
	{
		$log_link = 'logout.php';
		$log_link_name = '<a href="logout.php" class="logout"></a>';
	}
	else
	{
		$log_link = 'login.php';
		$log_link_name = '<a href="login.php" class="login"></a>';
	}
?>
<!DOCTYPE html>
<html>
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Pela</title>

	<meta name="description" content="Pela-website for woman collection" />
	<meta name="keywords" content="Pela,clothes,dress,sale" />
	<meta name="copyright" content="www.pela.com" />
	<meta name="author" content="www.pela.com" />
	<meta name="owner" content="Pela" />
	<meta name="robots" content="index,follow" />
	<meta name="robots" content="all" />
	<meta name="googlebot" content="INDEX,FOLLOW"/>
	<meta name="revisit-after" content="3 days" />
	<meta http-equiv="imagetoolbar" content="no" />
	
	<link rel="shortcut icon" href="images/icon.ico" type="image/x-icon" />
	<link rel="icon" href="images/icon.ico" type="image/x-icon" />

    <link href="themes/6/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="themes/6/js-image-slider.js" type="text/javascript"></script>

	<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="wrapper">
<div class="headerWrp">
<header>
	
	<div class="logo">
	</div>
</header>
</div>
<div class="menuWrp">
<nav>
			<a class="home" href="index.php"></a>
			<a class="add_blog" href="add_blog.php"></a>
			<a class="add_user" href="adduser.php"></a>
			<?php echo $log_link_name; ?>
	
</nav>
<div class="line1"></div>
</div>

<?php
	if(isset($_SESSION['access_level']) && $_SESSION['access_level'] == 5)
	{
		include 'includes/admin_menu.php';
	}
?>
