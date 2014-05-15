<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.4.custom.css">
  <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui-1.10.4.custom.js"></script>
  <script>
  $(function() {
    $( "#accordion" ).accordion();
  });
  $(function() {
    $( "#datepicker" ).datepicker();
	
  });
  </script>
</head>

<div id="accordion">
  <h3>Create Standard Account</h3>
  <div>
	<h1>Account Information:</h1><br>
	<form action="CustomerAssistantHome" method="post" >
		<b><?php echo "Customer ID: "?><input type="text" name="cid"></b><br><br>
		<b><?php echo "Account IBAN: "?><input type="text" name="iban"></b><br><br>
		<b><?php echo "Branch Name: "?><input type="text" name="bName"></b><br><br>
		<b><input name="submit" type="submit" value="Submit Standard Account"></b><br><br>
	</form>
  </div>
  <h3>Create Business Account</h3>
  <div>
	<h1>Business Account Information:</h1><br>
	<form action="CustomerAssistantHome" method="post" >
		<b><?php echo "Customer ID: "?><input type="text" name="cid"></b><br><br>
		<b><?php echo "Account IBAN: "?><input type="text" name="iban"></b><br><br>
		<b><?php echo "Branch Name: "?><input type="text" name="bName"></b><br><br>
		<b><input name="submit" type="submit" value="Submit Business Account"></b><br><br>
	</form>
  </div>
  <h3>Create Savings Account</h3>
  <div>
	<h1>Savings Account Information:</h1><br>
	<form action="CustomerAssistantHome" method="post" >
		<b><?php echo "Customer ID: "?><input type="text" name="cid"></b><br><br>
		<b><?php echo "Account IBAN: "?><input type="text" name="iban"></b><br><br>
		<b><?php echo "Branch Name: "?><input type="text" name="bName"></b><br><br>
		<b>Date End: <input name="dateEnd" type="text" id="datepicker"></b><br><br>
		<b><input name="submit" type="submit" value="Submit Savings Account"></b><br><br>
	</form>
  </div>
</div>
