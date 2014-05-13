<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?> </title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="js/jquery-2.1.1.min.js"></script>
</head>
<body>
<div id="header">
    <?php echo $title ?>
    <?php if(isset($showlogout)){ ?>
            <div class="logout"><a href="logout">Logout</a></div>
    <?php }?>
</div>
<div id="body">
    
