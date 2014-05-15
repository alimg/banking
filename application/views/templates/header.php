<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title><?php echo $title ?> </title>
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.10.4.custom.css">
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui-1.10.4.custom.js"></script>
</head>
<body>
<div id="header">
    <?php echo $title ?>
    <?php if(isset($showlogout)){ ?>
            <div class="logout"><a href="logout">Logout</a></div>
    <?php }?>
</div>
<div id="body">
    
