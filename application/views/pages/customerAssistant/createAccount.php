

<div id="accordion">
  <h3>Create Standard Account</h3>
  <div>
	<h1>Account Information:</h1><br>
	<form action="customerAssistantHome" method="post" >
		<b><?php echo "Customer ID: "?><input type="text" name="cid"></b><br><br>
		<b><?php echo "Account IBAN: "?><input type="text" name="iban"></b><br><br>
		<b><?php echo "Branch Name: "?><input type="text" name="bName"></b><br><br>
		<b><input name="submit" type="submit" value="Submit Standard Account"></b><br><br>
	</form>
  </div>
  <h3>Create Business Account</h3>
  <div>
	<h1>Business Account Information:</h1><br>
	<form action="customerAssistantHome" method="post" >
		<b><?php echo "Customer ID: "?><input type="text" name="cid"></b><br><br>
		<b><?php echo "Account IBAN: "?><input type="text" name="iban"></b><br><br>
		<b><?php echo "Branch Name: "?><input type="text" name="bName"></b><br><br>
		<b><input name="submit" type="submit" value="Submit Business Account"></b><br><br>
	</form>
  </div>
  <h3>Create Savings Account</h3>
  <div>
	<h1>Savings Account Information:</h1><br>
	<form action="customerAssistantHome" method="post" >
		<b><?php echo "Customer ID: "?><input type="text" name="cid"></b><br><br>
		<b><?php echo "Account IBAN: "?><input type="text" name="iban"></b><br><br>
		<b><?php echo "Branch Name: "?><input type="text" name="bName"></b><br><br>
		<b>Date End: <input name="dateEnd" type="text" id="datepicker"></b><br><br>
		<b><input name="submit" type="submit" value="Submit Savings Account"></b><br><br>
	</form>
  </div>
</div>

  <script>
    $( "#accordion" ).accordion();
    $( "#datepicker" ).datepicker();
	document.ready();
  </script>
