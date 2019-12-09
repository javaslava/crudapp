<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $data["atributes"]["title"] ?></title>
<link rel="stylesheet" type="text/css" href="/css/general_view_style.css" />
<link rel="stylesheet" type="text/css" href="/css/start_slider_style.css" />
<link rel="stylesheet" type="text/css" href="/css/login_form_style.css" />
<link rel="stylesheet" type="text/css" href="/css/data_processing_form_style.css" />
<link rel="stylesheet" type="text/css" href="/css/searchResult_table_style.css" />
<script type="text/javascript" src="/js/login_form_script.js"></script>

</head>
<body>

<header>
	<hgroup>
	<div class='main_menu'>
	<div id='logo'><h1><?php echo $data['atributes']['logo']; ?></h1></div>
	<div class='loginBlock'><?php echo $data['loginout'];?></div>
	</div>
	</hgroup>
</header>

<?php 
	include $content_view;
 ?>
</body>
</html>